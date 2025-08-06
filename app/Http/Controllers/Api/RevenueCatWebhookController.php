<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;
use Carbon\Carbon;
use Laravelcm\Subscriptions\Models\Feature;
use Laravelcm\Subscriptions\Interval;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RevenueCatWebhookController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
//        $token = $request->bearerToken();
//
//        if (!$token) {
//            Log::error('Missing Authorization header in webhook request.');
//            return response()->json(['message' => 'Unauthorized'], 401);
//        }
//
//        try {
//            $payload = JWTAuth::setToken($token)->getPayload();
//
//            // Optional: Check issuer or subject if needed
//            $issuer = $payload->get('iss'); // e.g., https://app.beestera.com/api/login
//            $userId = $payload->get('sub');
//
//            Log::info('Webhook authorized. JWT payload:', [
//                'iss' => $issuer,
//                'sub' => $userId,
//            ]);
//
//            // You can proceed to handle webhook data here
//
//        } catch (JWTException $e) {
//            Log::error('Invalid JWT in webhook request.', ['error' => $e->getMessage()]);
//            return response()->json(['message' => 'Unauthorized'], 401);
//        }

        // Proceed with processing the webhook
        $event = $request->input('event');

        // Extract necessary data from the webhook
        $userId        = (int) ($event['app_user_id'] ?? 0);
        $eventType = $event['type'] ?? null;
        $productId = $event['product_id'] ?? null;
        $newProductId = $event['new_product_id'] ?? null;
        $purchasedAtMs = $event['purchased_at_ms'] ?? null;
        $expirationAtMs = $event['expiration_at_ms'] ?? null;

        if (!$userId || !$eventType || !$productId) {
            Log::error('Invalid webhook data: missing required fields.', [
                'user_id' => $userId,
                'event_type' => $eventType,
                'product_id' => $productId
            ]);
            Log::info('Raw webhook payload:', $request->all());
            return response()->json(['message' => 'Invalid data'], 400);
        }

        // Find the user by user_id
        $user = User::find($userId);

        if (!$user) {
            Log::error('User not found for user_id: ' . $userId);
            return response()->json(['message' => 'User not found'], 404);
        }

        // Convert timestamps to Carbon instances
        $purchasedDate = $purchasedAtMs ? Carbon::createFromTimestampMs($purchasedAtMs) : now();
        $expirationDate = $expirationAtMs ? Carbon::createFromTimestampMs($expirationAtMs) : null;

        // Handle different event types
        try {
            switch ($eventType) {
                case 'PRODUCT_CHANGE':
                    $this->handleProductChange($user, [
                        'old_product_id' => $productId,
                        'new_product_id' => $newProductId,
                        'purchased_date' => $purchasedDate,
                        'expiration_date' => $expirationDate,
                    ]);
                    break;

                case 'INITIAL_PURCHASE':
                    $this->handleInitialPurchase($user, [
                        'product_id' => $productId,
                        'purchased_date' => $purchasedDate,
                        'expiration_date' => $expirationDate,
                    ]);
                    break;

                case 'RENEWAL':
                    $this->handleRenewal($user, [
                        'product_id' => $productId,
                        'purchased_date' => $purchasedDate,
                        'expiration_date' => $expirationDate,
                    ]);
                    break;

                case 'CANCELLATION':
                    $this->handleCancellation($user, [
                        'product_id' => $productId,
                    ]);
                    break;

                case 'EXPIRATION':
                    $this->handleExpiration($user, [
                        'product_id' => $productId,
                    ]);
                    break;

                case 'NON_RENEWING_PURCHASE':
                    $this->handleNonRenewingPurchase($user, [
                        'product_id' => $productId,
                        'purchased_date' => $purchasedDate,
                        'expiration_date' => $expirationDate,
                    ]);
                    break;

                case 'SUBSCRIPTION_EXTENDED':
                    $this->handleSubscriptionExtended($user, [
                        'product_id' => $productId,
                        'expiration_date' => $expirationDate,
                    ]);
                    break;

                case 'UNCANCELLATION':
                    $this->handleUncancellation($user, [
                        'product_id' => $productId,
                    ]);
                    break;

                case 'SUBSCRIPTION_PAUSED':
                    $this->handleSubscriptionPaused($user, [
                        'product_id' => $productId,
                        'expiration_date' => $expirationDate,
                    ]);
                    break;

                default:
                    Log::warning('Unhandled event type: ' . $eventType);
                    return response()->json(['message' => 'Unhandled event type'], 200);
            }

            Log::info('RevenueCat webhook processed successfully', [
                'event_type' => $eventType,
                'user_id' => $userId,
                'product_id' => $productId,
                'new_product_id' => $newProductId,
                'purchased_at' => $purchasedDate?->toIso8601String(),
                'expires_at' => $expirationDate?->toIso8601String()
            ]);

        } catch (\Exception $e) {
            Log::error('Error processing webhook: ' . $e->getMessage(), [
                'event_type' => $eventType,
                'user_id' => $userId,
                'product_id' => $productId,
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Error processing webhook'], 500);
        }

        return response()->json(['message' => 'Event processed successfully'], 200);
    }

    private function handleProductChange(User $user, array $event)
    {
        $oldProductId = $event['old_product_id'];
        $newProductId = $event['new_product_id'];
        $purchasedDate = $event['purchased_date'];
        $expirationDate = $event['expiration_date'];

        // Get the new plan
        $newPlan = Plan::findByProductId($newProductId);

        if (!$newPlan) {
            Log::error("New plan not found for product_id: {$newProductId}");
            return;
        }

        // Get current subscription
        $subscription = $user->planSubscription($oldProductId);

        if ($subscription) {
            // Cancel the current subscription immediately
            $subscription->cancel(true);
        }

        // Create new subscription with the new plan
        $newSubscription = $user->newPlanSubscription($newProductId, $newPlan);

        // Set expiration date from RevenueCat
        if ($expirationDate) {
            $newSubscription->starts_at = $purchasedDate;
            $newSubscription->ends_at = $expirationDate;
            $newSubscription->save();
        }

        Log::info("Product change processed", [
            'user_id' => $user->id,
            'old_product_id' => $oldProductId,
            'new_product_id' => $newProductId,
            'new_plan' => $newPlan->name,
            'starts_at' => $purchasedDate->toIso8601String(),
            'expires_at' => $expirationDate?->toIso8601String()
        ]);
    }

    private function handleInitialPurchase(User $user, array $event)
    {
        $productId = $event['product_id'];
        $purchasedDate = $event['purchased_date'];
        $expirationDate = $event['expiration_date'];

        // Get the corresponding plan
        $plan = Plan::findByProductId($productId);

        if (!$plan) {
            Log::error("Plan not found for product_id: {$productId}");
            return;
        }

        // Cancel any active subscriptions if they exist
        $activeSubscription = $user->planSubscription($productId);
        if ($activeSubscription && $activeSubscription->active()) {
            $activeSubscription->cancel(true); // Immediately cancel
        }

        // Create new subscription with the start date from purchase

        $subscription = $user->newPlanSubscription($productId, $plan);

        // Set expiration date from RevenueCat
        if ($expirationDate) {
            $subscription->starts_at = $purchasedDate;
            $subscription->ends_at = $expirationDate;
            $subscription->save();
        }

        Log::info("Initial purchase processed", [
            'user_id' => $user->id,
            'plan' => $plan->name,
            'product_id' => $productId,
            'starts_at' => $purchasedDate->toIso8601String(),
            'expires_at' => $expirationDate?->toIso8601String()
        ]);
    }

    private function handleRenewal(User $user, array $event)
    {
        $productId = $event['product_id'];
        $purchasedDate = $event['purchased_date'];
        $expirationDate = $event['expiration_date'];

        // Find the plan by product_id
        $plan = Plan::findByProductId($productId);

        if (!$plan) {
            Log::error("Plan not found for product_id: {$productId}");
            return;
        }

        // Get the subscription
        $subscription = $user->planSubscription($productId);

        if ($subscription) {
            // Renew the subscription
            $subscription->renew();

            // Update expiration date from RevenueCat
            if ($expirationDate) {
                $subscription->ends_at = $expirationDate;
                $subscription->save();
            }

            Log::info("Subscription renewed", [
                'user_id' => $user->id,
                'plan' => $plan->name,
                'starts_at' => $purchasedDate->toIso8601String(),
                'expires_at' => $expirationDate?->toIso8601String()
            ]);
        }
    }

    private function handleCancellation(User $user, array $event)
    {
        $productId = $event['product_id'];

        // Find the plan by product_id
        $plan = Plan::findByProductId($productId);

        if (!$plan) {
            Log::error("Plan not found for product_id: {$productId}");
            return;
        }

        // Get and cancel the subscription
        $subscription = $user->planSubscription($productId);

        if ($subscription && $subscription->active()) {
            // Keep the current ends_at date (will remain active until the end of the period)
            $subscription->cancel();

            Log::info("Subscription cancelled", [
                'user_id' => $user->id,
                'plan' => $plan->name,
                'expires_at' => $subscription->ends_at?->toIso8601String()
            ]);
        }
    }

    private function handleExpiration(User $user, array $event)
    {
        $productId = $event['product_id'];

        // Find the plan by product_id
        $plan = Plan::findByProductId($productId);

        if (!$plan) {
            Log::error("Plan not found for product_id: {$productId}");
            return;
        }

        // Get the subscription
        $subscription = $user->planSubscription($productId);

        if ($subscription && $subscription->active()) {
            // Set ends_at to now to mark it as expired
            $subscription->ends_at = now();
            $subscription->save();

            // Clear usage data
            $subscription->usage()->delete();

            Log::info("Subscription expired", [
                'user_id' => $user->id,
                'plan' => $plan->name,
                'expired_at' => now()->toIso8601String()
            ]);
        }
    }

    private function handleNonRenewingPurchase(User $user, array $event)
    {
        $productId = $event['product_id'];
        $purchasedDate = $event['purchased_date'];
        $expirationDate = $event['expiration_date'];

        // Find the plan by product_id
        $plan = Plan::findByProductId($productId);

        if (!$plan) {
            Log::error("Plan not found for product_id: {$productId}");
            return;
        }

        // Create new subscription with the non-recurring flag
        $subscription = $user->newPlanSubscription($productId, $plan, $purchasedDate);

        // Set expiration date from RevenueCat
        if ($expirationDate) {
            $subscription->ends_at = $expirationDate;
            $subscription->save();
        }

        Log::info("Non-renewing purchase processed", [
            'user_id' => $user->id,
            'plan' => $plan->name,
            'product_id' => $productId,
            'starts_at' => $purchasedDate->toIso8601String(),
            'expires_at' => $expirationDate?->toIso8601String()
        ]);
    }

    private function handleSubscriptionExtended(User $user, array $event)
    {
        $productId = $event['product_id'] ?? null;
        $expirationDate = $event['expiration_date'] ?? null;

        // Get the corresponding plan
        $plan = Plan::findByProductId($productId);

        if (!$plan) {
            Log::error("Plan not found for product_id: {$productId}");
            return;
        }

        // Get the subscription
        $subscription = $user->planSubscription($productId);

        if ($subscription && $subscription->active()) {
            if ($expirationDate) {
                $subscription->ends_at = $expirationDate;
                $subscription->save();
            }
            Log::info("Subscription extended for user {$user->id} with plan {$plan->name}");
        }
    }

    private function handleUncancellation(User $user, array $event)
    {
        $productId = $event['product_id'] ?? null;

        // Get the corresponding plan
        $plan = Plan::findByProductId($productId);

        if (!$plan) {
            Log::error("Plan not found for product_id: {$productId}");
            return;
        }

        // Get the subscription
        $subscription = $user->planSubscription($productId);

        if ($subscription && $subscription->canceled()) {
            // Remove cancellation flags
            $subscription->ends_at = null;
            $subscription->save();
            Log::info("Subscription resumed for user {$user->id} with plan {$plan->name}");
        }
    }

    private function handleSubscriptionPaused(User $user, array $event)
    {
        $productId = $event['product_id'] ?? null;
        $expirationDate = $event['expiration_date'] ?? null;

        // Get the corresponding plan
        $plan = Plan::findByProductId($productId);

        if (!$plan) {
            Log::error("Plan not found for product_id: {$productId}");
            return;
        }

        // Get the subscription
        $subscription = $user->planSubscription($productId);

        if ($subscription && $subscription->active()) {
            // Set temporary end date for the pause period
            if ($expirationDate) {
                $subscription->ends_at = $expirationDate;
                $subscription->save();
            }
            Log::info("Subscription paused for user {$user->id} with plan {$plan->name}");
        }
    }
}
