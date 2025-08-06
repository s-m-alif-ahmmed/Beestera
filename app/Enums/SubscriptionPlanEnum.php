<?php

namespace App\Enums;

class SubscriptionPlanEnum
{
    // Apple Device
    public const basicMonthly = 'beestera.basic.monthly';

    public const basicYearly = 'beestera.basic.yearly';

    public const proMonthly = 'beestera.pro.monthly';

    public const proYearly = 'beestera.pro.yearly';

    public const trainingYearly = 'beestera.training.yearly';

    public const trainingByYearly = 'beestera.training.bi_yearly';


    // Android Device
    public const basicMonthlyAndroid = 'beesterabasic_999_1m:beestera-basic-monthly';

    public const basicYearlyAndroid = 'beestera.basic.yearly:beestera-basic-yearly-10999';

    public const proMonthlyAndroid = 'beestera.pro.monthly:beestera-pro-monthly1999';

    public const proYearlyAndroid = 'beestera.pro.yearly:beestera-pro-yearly-21999';

    public const trainingYearlyAndroid = 'beestera.training.yearly:beetera-training-yearly-32999';

    public const trainingByYearlyAndroid = 'beestera.training.biyeary:beestera-training-bi-yearly-21999';


}
