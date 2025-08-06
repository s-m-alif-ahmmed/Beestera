{{-- @php
$systemSetting = App\Models\SystemSetting::first();
@endphp --}}

<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('dashboard') }}">
                <img src="{{ asset($setting->logo ?? 'backend/images/brand/logo.png') }}"
                    class="header-brand-img light-logo1 dark-logo1" alt="logo">
            </a>
        </div>

        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>

            <ul class="side-menu">
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                            enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                            <path
                                d="M19.9794922,7.9521484l-6-5.2666016c-1.1339111-0.9902344-2.8250732-0.9902344-3.9589844,0l-6,5.2666016C3.3717041,8.5219116,2.9998169,9.3435669,3,10.2069702V19c0.0018311,1.6561279,1.3438721,2.9981689,3,3h2.5h7c0.0001831,0,0.0003662,0,0.0006104,0H18c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-8.7930298C21.0001831,9.3435669,20.6282959,8.5219116,19.9794922,7.9521484z M15,21H9v-6c0.0014038-1.1040039,0.8959961-1.9985962,2-2h2c1.1040039,0.0014038,1.9985962,0.8959961,2,2V21z M20,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2h-2v-6c-0.0018311-1.6561279-1.3438721-2.9981689-3-3h-2c-1.6561279,0.0018311-2.9981689,1.3438721-3,3v6H6c-1.1040039-0.0014038-1.9985962-0.8959961-2-2v-8.7930298C3.9997559,9.6313477,4.2478027,9.0836182,4.6806641,8.7041016l6-5.2666016C11.0455933,3.1174927,11.5146484,2.9414673,12,2.9423828c0.4853516-0.0009155,0.9544067,0.1751099,1.3193359,0.4951172l6,5.2665405C19.7521973,9.0835571,20.0002441,9.6313477,20,10.2069702V19z" />
                        </svg>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                {{-- Home --}}

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path fill="#000"
                                d="M 12 2.0996094 L 1 12 L 4 12 L 4 21 L 10 21 L 10 14 L 14 14 L 14 21 L 20 21 L 20 12 L 23 12 L 12 2.0996094 z">
                            </path>
                        </svg>
                        <span class="side-menu__label"style="margin-left: 8px;">Home</span><i
                            class="angle fa fa-angle-right"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('user.task.index') }}" class="slide-item">Task</a></li>
                    </ul>
                    <ul class="slide-menu">
                        <li><a href="{{ route('user.task.history') }}" class="slide-item">Task History (Pending
                                List)</a></li>
                    </ul>
                    <ul class="slide-menu">
                        <li><a href="{{ route('user.approved.task') }}" class="slide-item">Approved List</a></li>
                    </ul>
                </li>

                {{-- CMS : Player Challenge and LeaderBoard --}}
                <li class="slide {{ request()->is('cms*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('cms*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="#">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAADSUlEQVR4nO2bW4hNURjHfzPHMHgxjbsHSjxMUUJ4wYPkRRRDkZQpuUxK8oA8uDzwIKFcIiMekDwQKW8SE0lDkUtePDBIjNswY2x99Z1a7c5lzpm1Z619Wv9andlr7b2+b/3mW9/anbUOBAUFlagVQBvQDUT9VB4Co/FAK/tx0PHyFKhzDaBNndkCDMjRnnXWpkwId4DBOFSXOpJr8EkD+Kif1wrYT1xRkQEmCWAq8EX/vgBUWbbjPQDRfKBTr49atpMKAKIlxgq03bKtVAAQrQX+aWmybC8VAEQ7tf4vsMyyzVQAEB3SNskLcy3bTQUAWQnOansHMM2ybe8BiGqAG8a7wmTL9r0B0NvyyrJ95wDulgGhogCUogCAEAGEKUCCikIOICTByGUWLqKQBAlJkJAEcTjHopADCEkwwp1CEiQkQUISxOEciyotCd4r49sY30pLXwBEFVDe2QCQVjkFUAtsBq4Dt4B9wEijvRG4COw26oYBp4FzuhssygAbgZs6Jc+U8P2/MwBDgFagR/fzxemvQDswUe+5r33L/t54rWsybO7RuoN6j/SxA3gB/DYAeQlgrz63yaibrgcsjul1qwKJjA3Oy0ad9CF6Drw2+hGA3zSCvAXwEvisuzamxOnZBoBHOjiZCtXAJ+BSDED2+jawDhin0wufAfzR80SFlAUgc/6DRojY2hADUKfh32H4I1thw30G0A68yVG/OEcErDaOvUjOaIgBqNfokP/6QuBKCeu7MwDn9bkpRt0InbunYgDG6r09GjWjDACyAnwH9hv9ZHQ7/IFPAOqBk8AEvZ4E/ATeAs2a5J7o0ZZZMQDZnCF2DscAZPcGO/Vo3jzguLYf8AnADOAHsMiom6nOZ8/zPAMWGO0tGvaiXbq0zdHE+R5YpW1jgKvGET2xcwIY5NsUyOSpr85zuLEqdtQtE3smroE6jeSztwqvwliKgCjFpU8AHnswgL4WOV9ctmqBIzk6tb1s2lLcT1mOh9roeI1m37QA+AWst915Q4oANCRtwHcAzgxEAQAhAiLcKfEI7FIDNa4cKKAatS0+Jv6jqa15ILgCIL5sU9vy8paYlnrwZlesLCdhNSrl/vzhZLHSrT4lPvigICpL/wFHPA2r404dFAAAAABJRU5ErkJggg=="
                            alt="external-cms-file-extension-web-format-file-creatype-outline-colourcreatype"
                            width="25" height="25" />

                        <span class="side-menu__label"style="margin-left: 8px;">CMS</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>

                    <ul class="slide-menu">
                        <li class="sub-title {{ request()->is('cms*') ? 'active is-expanded' : '' }}">
                            <a class="side-menu__item {{ request()->is('cms*') ? 'active is-expanded' : '' }}"
                                data-bs-toggle="slide" href="#">
                                <span class="side-menu__label">Progress</span><i
                                    class="angle fa fa-angle-right"></i>
                            </a>
                            <ul class="slide-menu">
                                <li><a href="{{ route('cms.challenge.banner') }}" class="slide-item">Player
                                        Challenge</a></li>
                                <li><a href="{{ route('cms.leaderboard.banner') }}" class="slide-item">Leaderboard</a>
                                </li>
                                <li><a href="{{ route('cms.roadmap.banner') }}" class="slide-item">RoadMap</a></li>
                                <li><a href="{{ route('cms.achievement.banner') }}" class="slide-item">Achievement</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="slide-menu">
                        <li class="sub-title {{ request()->is('cms*') ? 'active is-expanded' : '' }}">
                            <a class="side-menu__item {{ request()->is('cms*') ? 'active is-expanded' : '' }}"
                                data-bs-toggle="slide" href="#">
                                <span class="side-menu__label">Train</span><i class="angle fa fa-angle-right"></i>
                            </a>
                            <ul class="slide-menu">
                                <li><a href="{{ route('cms.train.control.banner') }}" class="slide-item">Controll</a>
                                </li>
                                <li><a href="{{ route('cms.train.solo-training.banner') }}" class="slide-item">Solo
                                        Training</a></li>
                                <li><a href="{{ route('cms.train.partner-training.banner') }}"
                                        class="slide-item">Partner Training</a></li>
                                <li><a href="{{ route('cms.train.challenges.banner') }}"
                                        class="slide-item">Challenges</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="slide-menu">
                        <li class="sub-title">
                            <a class="side-menu__item" data-bs-toggle="slide" href="#">
                                <span class="side-menu__label">Learn</span><i class="angle fa fa-angle-right"></i>
                            </a>
                            <ul class="slide-menu">
                                <li><a href="{{ route('cms.learn.mindset.banner') }}" class="slide-item">Mindset</a>
                                </li>
                                <li><a href="{{ route('cms.learn.position-specific.banner') }}"
                                        class="slide-item">Position Specific</a></li>
                                <li><a href="{{ route('cms.learn.guide-book.banner') }}"
                                        class="slide-item">Guidebook</a></li>
                                <li><a href="{{ route('cms.learn.general.banner') }}" class="slide-item">General</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                {{-- Train All Options --}}
                <li class="slide {{ request()->is('cms*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('cms*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="#">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAADbElEQVR4nO2bbWiNYRjHf8fMMkVaiOwDZQtJStlCKKO8FLXMpxWFIS+xkihvH6YkyYdJvsxLFPlAUlq+aKws2QdR3sLy0jY+GBtzdnTXdWo9Pc9p53mu+znPnOdf/zqdl+u6/v9zznPf93XfD8SIESOGHRQBi4CDwBWgFegAvgFJ4I88Ns+1AFeBw0AVMI5higSwQgT3ACmf7AeagR3AeIYJqoH2AKK9aIxsBKYRUUwH7lsQ7mQv0ACMIUJYDXwPQfxgvgUqiAB2AgMhi0+zD9iQS/Hbcyg+TTOSbM2F+Cq5SudS/GAT1oUpfjLQHQHhzlGiPCwDbkVAsBsfAQW2xS+LgNBMrLNtQEsERGbiB5l+W8F8S0WfEmrF22TLgPMWxDfJ2iEhjzViPrAhfgTwRVn8XaBwUI5CeU5jWJyibcACC1fsYpc8xfJa0PgbtQ3Yoyj+OVCSIVeJvCdIjnPaBlxSvEqXDiFfqbzXbx7TR4jc8NcFzMoi5wzgq89cr7QN+BhQ/E+g0kfeSvmsn3yq+BFAvOn7rQqQeznw20dOVfz1Kd4sl2sV8tdmufQ2Q6Eqen0aUK9YQ30WeU29quhSuAg66TVnvw28EXZK2zzbv6AZQVTRbsEAr7nAZ4XYbdoG3LRggFeL+5dC7G6PmWYo/7/UEDnXJU+RYvzjmgbMs2CA2TJzYpJy13iOpgkvlQ1wmxuUK+d46lhxBsI25eJqXHJUWPilHdMyYBTwXrGwLS45VlowoN/nNNwVmxUL2+cSv8aCAemtNJXt9oQsNTWKOuKx25SyxBsooUxprD7tEvuARQNUG6b7FYq54BK3wbIBajPEAoUmyXWXuI0WxT8BpqI8OUoGKMh0gJ24ZkF4h/Q0rWybNQUo7KFLvHuKwl/LVt5ILB+NSfos8JlLvMeKBlwkJDQHGJudeKFowO6wDNjrs0DT7LDRC0hzSVgGLAywWnOiT0n8QJhnCycqfmtaNGuW0FAUAcFOmr5iqEhFjCfy3YDqfDegLJ8N6JEDHXlrQGvY4omA6DTfebTbrSOVY3bKlX9sLsQTkkhzRHeN3FJzUrgLWGp7xRcVAyKNVGwA+f0LGC2HE2fLnt9auZHhKHBWTpndkabkJ5/3GvxXSAATgJnAYmC9GHYIOANclvZYm6zs1A89xYgRgzT+ATMqdQI/jjy5AAAAAElFTkSuQmCC"
                            alt="learn-more"width="25" height="25">
                        <span class="side-menu__label"style="margin-left: 8px;">Train and Learn</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('train.content.list') }}" class="slide-item">Train Contents</a></li>
                        <li><a href="{{ route('learn.content.list') }}" class="slide-item">Learn Contents</a></li>
                        <li><a href="{{ route('category.list') }}" class="slide-item">Categories</a></li>
                    </ul>
                </li>

                <li class="slide {{ request()->is('cms*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('cms*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="#">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA5ElEQVR4nO3TMUoDQRQG4C8iQcTOxmOksFcLU6cWO8EDpIhFTmCbG3gIsbCwMIuQSmxstbATUqXUDYEVhkCIozPKwv4wMMW8+ZjHPJrUJNd4xaTaX2H4F/AhyqXVz43uYYTPAH3BVi5wF5eYVdhHAJ/mAHdwgWkA3aKDOzxiIyW4jQHeA/AG+8GZAxynAts4x1sAFjiSKZs4q8bkC1yMSzfyniKov/9OwUNQ8IQeWj94wPKYrc0Yzzj55WeJhiVqaXa4XAHUHy4iW5oMLiOB+sBFopZGw2UioIHXpmn1v89xk3pmDlCA4hTVtdp7AAAAAElFTkSuQmCC"
                            alt="positive-dynamic"width="25" height="25">

                        <span class="side-menu__label"style="margin-left: 8px;">Progress</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('achievement.content.list') }}" class="slide-item">Achievement
                                Contents</a></li>
                        <li><a href="{{ route('roadmap.content.list') }}" class="slide-item">RoadMap Contents</a>
                        </li>
                        {{-- <li><a href="{{ route('category.list') }}" class="slide-item">Categories</a></li> --}}
                    </ul>
                </li>

                {{-- <li class="slide {{ request()->is('cms*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('cms*') ? 'active is-expanded' : '' }}" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="30px" height="30px">
                            <circle cx="128" cy="128" r="120" fill="#382b73" />
                            <circle cx="128" cy="128" r="102.5" fill="#473080" />
                            <path fill="#382b73"
                                d="M202.109,126.58h-38.394c-1.045,0-1.891,0.847-1.891,1.891v43.511c0,1.045,0.847,1.891,1.891,1.891h38.394 c1.045,0,1.891-0.847,1.891-1.891v-43.511C204,127.426,203.153,126.58,202.109,126.58z" />
                            <path fill="#382b73"
                                d="M165.426,88.628v-4.41c0-13.26-10.75-24.01-24.01-24.01c-13.26,0-24.01,10.749-24.01,24.01v4.41 c0,2.763,0.467,5.418,1.326,7.889H76.402c-3.696,0-6.691,2.996-6.691,6.692v53.228c-6.712,4.451-11.138,12.075-11.138,20.733 c0,13.73,11.13,24.86,24.86,24.86c8.62,0,16.214-4.387,20.674-11.05h39.211c3.696,0,6.692-2.996,6.692-6.692v-73.234 C159.025,107.597,165.426,98.86,165.426,88.628z" />
                            <g>
                                <path fill="#fff"
                                    d="M143.318,183.979H76.402c-3.696,0-6.692-2.996-6.692-6.692v-81.08c0-3.696,2.996-6.692,6.692-6.692h66.916 c3.696,0,6.692,2.996,6.692,6.692v81.08C150.009,180.983,147.014,183.979,143.318,183.979z" />
                                <path fill="#d1d3d4"
                                    d="M136.099,136.323H83.621c-2.016,0-3.65-1.634-3.65-3.65v0c0-2.016,1.634-3.65,3.65-3.65h52.478 c2.016,0,3.65,1.634,3.65,3.65v0C139.749,134.689,138.115,136.323,136.099,136.323z" />
                                <path fill="#d1d3d4"
                                    d="M136.099,153.194H83.621c-2.016,0-3.65-1.634-3.65-3.65l0,0c0-2.016,1.634-3.65,3.65-3.65h52.478 c2.016,0,3.65,1.634,3.65,3.65l0,0C139.749,151.56,138.115,153.194,136.099,153.194z" />
                                <path fill="#d1d3d4"
                                    d="M136.099,170.065H83.621c-2.016,0-3.65-1.634-3.65-3.65l0,0c0-2.016,1.634-3.65,3.65-3.65h52.478 c2.016,0,3.65,1.634,3.65,3.65l0,0C139.749,168.431,138.115,170.065,136.099,170.065z" />
                                <path fill="#d1d3d4"
                                    d="M137.072,99.442H82.647c-1.478,0-2.677,1.198-2.677,2.677v13.16c0,1.478,1.198,2.677,2.677,2.677h54.425 c1.478,0,2.677-1.198,2.677-2.677v-13.16C139.749,100.64,138.551,99.442,137.072,99.442z" />
                                <g>
                                    <path fill="#e7ad27"
                                        d="M202.109,166.874h-38.394c-1.045,0-1.891-0.847-1.891-1.891v-41.431c0-1.045,0.847-1.891,1.891-1.891 h38.394c1.045,0,1.891,0.847,1.891,1.891v41.431C204,166.027,203.153,166.874,202.109,166.874z" />
                                    <path fill="#009add"
                                        d="M202.109,164.793h-38.394c-1.045,0-1.891-0.847-1.891-1.891v-41.431c0-1.045,0.847-1.891,1.891-1.891 h38.394c1.045,0,1.891,0.847,1.891,1.891v41.431C204,163.946,203.153,164.793,202.109,164.793z" />
                                    <path fill="#f7cb15"
                                        d="M173.9,145.078l-12.068,17.725c0.048,1.106,0.953,1.99,2.071,1.99h26.859l-13.423-19.715 C176.514,143.865,174.726,143.865,173.9,145.078z" />
                                    <path fill="#f7cb15"
                                        d="M204,141.392l-5.347-7.854c-0.826-1.213-2.614-1.213-3.439,0l-21.28,31.255h27.986 c1.149,0,2.08-0.931,2.08-2.08V141.392z" />
                                    <path fill="#f7cb15"
                                        d="M180.951,132.941c0,2.944-2.387,5.331-5.331,5.331c-2.944,0-5.331-2.387-5.331-5.331 c0-2.944,2.387-5.331,5.331-5.331C178.564,127.61,180.951,129.997,180.951,132.941z" />
                                </g>
                                <g>
                                    <path fill="#e43d91"
                                        d="M117.406,81.627c0,13.26,10.75,24.01,24.01,24.01c13.26,0,24.01-10.75,24.01-24.01v-4.41 c0-13.26-10.75-24.01-24.01-24.01c-13.26,0-24.01,10.749-24.01,24.01V81.627z" />
                                    <circle cx="141.416" cy="77.217" r="24.01" fill="#ef5a9d"
                                        transform="rotate(-76.714 141.429 77.219)" />
                                    <g>
                                        <path fill="#e43d91"
                                            d="M134.616,88.316V72.64c0-2.259,2.558-3.568,4.39-2.247l10.873,7.838c1.534,1.106,1.534,3.389,0,4.495 l-10.873,7.838C137.174,91.884,134.616,90.574,134.616,88.316z" />
                                        <path fill="#fff"
                                            d="M134.616,84.609V68.933c0-2.259,2.558-3.568,4.39-2.247l10.873,7.838c1.534,1.106,1.534,3.389,0,4.495 l-10.873,7.838C137.174,88.177,134.616,86.867,134.616,84.609z" />
                                        <path fill="#d1d3d4"
                                            d="M149.88,76.875l-10.873,7.838c-1.832,1.321-4.39,0.012-4.39-2.247v2.143c0,2.259,2.558,3.568,4.39,2.247 l10.873-7.838c1.099-0.792,1.396-2.184,0.921-3.319C150.612,76.149,150.314,76.562,149.88,76.875z" />
                                    </g>
                                </g>
                                <g>
                                    <circle cx="83.432" cy="170.169" r="24.86" fill="#fede3a" />
                                    <path fill="#e7ad27"
                                        d="M99.555,169.435c-0.002-0.026-0.006-0.052-0.009-0.078c-0.016-0.111-0.045-0.219-0.085-0.322 c-0.001-0.002-0.002-0.004-0.002-0.006c-0.001-0.002-0.001-0.003-0.002-0.005c-0.172-0.434-0.543-0.775-1.016-0.897l-3.58-0.927 l1.409-2.393c0.135-0.229,0.201-0.482,0.205-0.734c0.001-0.013,0-0.025,0-0.038l0-1.807c0-0.008,0-0.016,0-0.024 c0.016-0.323-0.072-0.647-0.258-0.92c-0.001-0.001-0.001-0.002-0.002-0.003c-0.009-0.013-0.019-0.026-0.028-0.04 c-0.006-0.009-0.012-0.017-0.019-0.025c-0.003-0.005-0.007-0.009-0.011-0.014c-0.036-0.047-0.075-0.092-0.118-0.134l-2.4-2.4 c-0.302-0.301-0.706-0.451-1.11-0.437c-0.244,0.008-0.488,0.076-0.709,0.206l-3.76,2.214c-0.128-0.056-0.256-0.11-0.386-0.161 l-1.093-4.224c-0.12-0.463-0.45-0.828-0.871-1.005c-0.115-0.048-0.237-0.082-0.364-0.101c-0.022-0.003-0.044-0.006-0.066-0.008 c-0.049-0.005-0.099-0.008-0.149-0.008h-3.395c-0.048,0-0.095,0.003-0.142,0.007c-0.026,0.002-0.052,0.006-0.078,0.009 c-0.127,0.019-0.248,0.053-0.364,0.102c-0.42,0.177-0.747,0.541-0.867,1.003l-1.093,4.224c-0.13,0.051-0.258,0.105-0.386,0.161 l-3.76-2.214c-0.221-0.13-0.465-0.198-0.708-0.206c-0.404-0.014-0.809,0.136-1.111,0.437l-2.4,2.4 c-0.043,0.043-0.082,0.088-0.118,0.134c-0.004,0.005-0.007,0.009-0.011,0.014c-0.006,0.008-0.013,0.017-0.019,0.025 c-0.01,0.013-0.019,0.026-0.028,0.04c-0.001,0.001-0.001,0.002-0.002,0.003c-0.186,0.273-0.275,0.597-0.258,0.92 c0,0.008,0,0.016,0,0.024l0,1.845c0.004,0.252,0.07,0.505,0.205,0.734l1.409,2.393l-3.58,0.927 c-0.402,0.104-0.729,0.366-0.924,0.708c-0.011,0.02-0.022,0.039-0.032,0.06c-0.01,0.02-0.02,0.04-0.029,0.06 c-0.058,0.127-0.098,0.262-0.119,0.403c-0.004,0.026-0.007,0.052-0.009,0.078c-0.004,0.047-0.007,0.094-0.007,0.141v5.315 c0,0.682,0.461,1.278,1.122,1.449l3.579,0.926l-1.409,2.393c-0.153,0.26-0.219,0.55-0.205,0.836c0,0.004,0,0.008,0,0.011l0,1.769 c-0.017,0.409,0.132,0.818,0.436,1.122l2.401,2.401c0.482,0.482,1.23,0.578,1.818,0.231l3.762-2.215 c0.127,0.055,0.255,0.107,0.384,0.158l1.094,4.227c0.171,0.661,0.767,1.122,1.449,1.122h3.395c0.682,0,1.278-0.461,1.449-1.122 l1.094-4.227c0.129-0.051,0.257-0.103,0.384-0.158l3.762,2.215c0.588,0.346,1.336,0.251,1.818-0.231l2.401-2.401 c0.304-0.304,0.454-0.714,0.436-1.122l0-1.769c0-0.004,0-0.007,0-0.011c0.015-0.285-0.052-0.576-0.205-0.836l-1.409-2.393 l3.579-0.926c0.661-0.171,1.122-0.767,1.122-1.449v-5.315C99.562,169.529,99.559,169.482,99.555,169.435z M78.109,171.274 c0-2.94,2.383-5.323,5.323-5.323c2.94,0,5.323,2.383,5.323,5.323c0,2.94-2.383,5.323-5.323,5.323 C80.493,176.598,78.109,174.214,78.109,171.274z" />
                                    <path fill="#e43d91"
                                        d="M96.474,160.164c0.001-0.012-0.001-0.023,0-0.035c0.001-0.019-0.001-0.038,0-0.057 c-0.001-0.032-0.002-0.063-0.004-0.095c-0.021-0.357-0.164-0.705-0.431-0.973l-2.4-2.4c-0.484-0.482-1.231-0.578-1.818-0.23 l-3.762,2.214c-0.127-0.056-0.255-0.107-0.384-0.157l-1.095-4.228c-0.171-0.661-0.768-1.121-1.45-1.121h-3.395 c-0.682,0-1.279,0.461-1.45,1.121l-1.094,4.228c-0.129,0.05-0.257,0.102-0.384,0.157l-3.762-2.214 c-0.588-0.348-1.335-0.252-1.818,0.23l-2.4,2.4c-0.267,0.268-0.41,0.616-0.431,0.973c-0.003,0.032-0.004,0.063-0.004,0.095 c0,0.019-0.001,0.038,0,0.057c0,0.012-0.001,0.023,0,0.035l0,1.845c0.004,0.252,0.07,0.505,0.205,0.734l1.409,2.393 l-3.58,0.927c-0.661,0.171-1.121,0.768-1.121,1.45v5.315c0,0.682,0.461,1.278,1.122,1.449l3.58,0.927l-1.409,2.393 c-0.139,0.236-0.204,0.497-0.205,0.757c0,0.005-0.001,0.009-0.001,0.014c-0.001,0.013,0,0.025,0,0.038 c-0.001,0.013,0,0.025,0,0.038l0,1.769c-0.017,0.409,0.132,0.818,0.436,1.122l2.401,2.401c0.483,0.483,1.23,0.578,1.818,0.232 l3.762-2.215c0.127,0.055,0.255,0.107,0.384,0.158l1.094,4.227c0.171,0.661,0.767,1.122,1.449,1.122h3.395 c0.682,0,1.278-0.461,1.449-1.122l1.094-4.227c0.129-0.051,0.257-0.103,0.384-0.158l3.762,2.215 c0.588,0.346,1.336,0.251,1.818-0.232l2.401-2.401c0.304-0.304,0.454-0.714,0.436-1.122l0-1.769c0-0.013,0.001-0.025,0-0.038 c0-0.013,0.001-0.025,0-0.038c0-0.005-0.001-0.009-0.001-0.014c0-0.26-0.065-0.521-0.205-0.757l-1.409-2.393l3.58-0.927 c0.661-0.171,1.122-0.767,1.122-1.449v-5.315c0-0.682-0.461-1.279-1.121-1.45l-3.58-0.927l1.409-2.393 c0.135-0.229,0.201-0.482,0.205-0.734c0.001-0.013,0-0.025,0-0.038L96.474,160.164z M83.433,174.554 c-2.947,0-5.345-2.398-5.345-5.345c0-2.947,2.398-5.345,5.345-5.345s5.345,2.398,5.345,5.345 C88.778,172.156,86.38,174.554,83.433,174.554z" />
                                    <path fill="#ef5a9d"
                                        d="M83.433,157.624c-6.398,0-11.585,5.187-11.585,11.585s5.187,11.585,11.585,11.585 s11.585-5.187,11.585-11.585S89.831,157.624,83.433,157.624z M83.433,174.532c-2.94,0-5.323-2.383-5.323-5.323 s2.383-5.323,5.323-5.323c2.94,0,5.323,2.383,5.323,5.323S86.372,174.532,83.433,174.532z" />
                                    <path fill="#ef5a9d"
                                        d="M86.281,160.518h-5.696c-0.979,0-1.695-0.924-1.449-1.872l1.151-4.445 c0.171-0.661,0.767-1.122,1.449-1.122h3.395c0.682,0,1.278,0.461,1.449,1.122l1.151,4.445 C87.975,159.594,87.26,160.518,86.281,160.518z" />
                                    <path fill="#ef5a9d"
                                        d="M80.584,177.899h5.696c0.979,0,1.695,0.924,1.449,1.872l-1.151,4.445 c-0.171,0.661-0.767,1.122-1.449,1.122h-3.395c-0.682,0-1.278-0.461-1.449-1.122l-1.151-4.445 C78.89,178.823,79.605,177.899,80.584,177.899z" />
                                    <path fill="#ef5a9d"
                                        d="M92.123,172.057v-5.696c0-0.979,0.924-1.695,1.872-1.449l4.445,1.151 c0.661,0.171,1.122,0.767,1.122,1.449v3.395c0,0.682-0.461,1.278-1.122,1.449l-4.445,1.151 C93.047,173.752,92.123,173.036,92.123,172.057z" />
                                    <path fill="#ef5a9d"
                                        d="M74.742,166.361v5.696c0,0.979-0.924,1.695-1.872,1.449l-4.445-1.151 c-0.661-0.171-1.122-0.767-1.122-1.449v-3.395c0-0.682,0.461-1.278,1.122-1.449l4.445-1.151 C73.818,164.666,74.742,165.381,74.742,166.361z" />
                                    <g>
                                        <path fill="#ef5a9d"
                                            d="M91.591,165.078l-4.028-4.028c-0.692-0.692-0.545-1.852,0.299-2.349l3.956-2.329 c0.588-0.346,1.336-0.251,1.818,0.232l2.401,2.401c0.483,0.483,0.578,1.23,0.232,1.818l-2.329,3.956 C93.444,165.622,92.284,165.77,91.591,165.078z" />
                                        <path fill="#ef5a9d"
                                            d="M75.274,173.34l4.028,4.028c0.692,0.692,0.545,1.852-0.299,2.349l-3.956,2.329 c-0.588,0.346-1.336,0.251-1.818-0.232l-2.401-2.401c-0.483-0.482-0.578-1.23-0.232-1.818l2.329-3.956 C73.421,172.795,74.581,172.647,75.274,173.34z" />
                                    </g>
                                    <g>
                                        <path fill="#ef5a9d"
                                            d="M87.564,177.368l4.028-4.028c0.692-0.692,1.852-0.545,2.349,0.299l2.329,3.956 c0.346,0.588,0.251,1.336-0.232,1.818l-2.401,2.401c-0.483,0.483-1.23,0.578-1.818,0.232l-3.956-2.329 C87.019,179.22,86.871,178.06,87.564,177.368z" />
                                        <path fill="#ef5a9d"
                                            d="M79.301,161.05l-4.028,4.028c-0.692,0.692-1.852,0.545-2.349-0.299l-2.329-3.956 c-0.346-0.588-0.251-1.336,0.232-1.818l2.401-2.401c0.483-0.483,1.23-0.578,1.818-0.232l3.956,2.329 C79.846,159.198,79.994,160.357,79.301,161.05z" />
                                    </g>
                                    <g>
                                        <path fill="#f06ea9"
                                            d="M83.433,178.906c-5.347,0-9.697-4.35-9.697-9.697s4.35-9.697,9.697-9.697s9.697,4.35,9.697,9.697 S88.779,178.906,83.433,178.906z M83.433,161.029c-4.51,0-8.18,3.669-8.18,8.18s3.669,8.18,8.18,8.18 c4.51,0,8.18-3.669,8.18-8.18S87.943,161.029,83.433,161.029z" />
                                    </g>
                                    <g>
                                        <path fill="#e43d91"
                                            d="M83.433,177.389c-4.51,0-8.18-3.669-8.18-8.18c0-4.51,3.669-8.18,8.18-8.18 c4.51,0,8.18,3.669,8.18,8.18C91.612,173.719,87.943,177.389,83.433,177.389z M83.433,163.863 c-2.947,0-5.345,2.398-5.345,5.345s2.398,5.345,5.345,5.345s5.345-2.398,5.345-5.345S86.38,163.863,83.433,163.863z" />
                                    </g>
                                </g>
                            </g>
                        </svg>

                        <span class="side-menu__label">Achievement</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('train.content.list') }}" class="slide-item">Train Contents</a></li>
                        <li><a href="{{ route('learn.content.list') }}" class="slide-item">Learn Contents</a></li>
                        <li><a href="{{ route('category.list') }}" class="slide-item">Categories</a></li>
                    </ul>
                </li> --}}

                {{-- User List --}}
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide"
                        href="{{ route('user_list.index') }}">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAAATklEQVR4nO2WMQoAMAjE/P+n0xdIwQqH9gIOboE4GGFMDs0zV+AVC+AE0XSEJPvt6vcIVNkjgDoBaoEqewRQJ0AtUMUCOEFMf0pRCZg/OHGl2yUPtaZmAAAAAElFTkSuQmCC"
                            alt="ingredients-list"width="25" height="25">
                        <span class="side-menu__label"style="margin-left: 8px;">User List</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide"
                        href="{{ route('user.leaderboard') }}">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABlUlEQVR4nO3XPUscQRjA8R9CLDSaIoWtXXIEKyFItFP8ApIq2AWLFPkYvhSpErBLmTrRUixU1CaEpIqQkO4sUgSCb03iysEcHAHP83a93THzhwcGZmd3/rszzzxLIpFIJBKJQujHCg6RXTPqWAr3KJ3lLgT+jUUVoB4m86SLsZMtX6Z0mm+1rPGF8d+IvLyiv/Iio9jH39hF7mMBW7GLNFntlUh/jgOtNUoXWS7gQNuugkg9x4HWCT0TyW54s90akavIs6TrrUVnO5EZHOAMX/BY8ewUVXRmbUS+YxeP8AN7qsVka9HZTqSxvp+F9jq+qR5Zc/6d7JExHOOViEWm8AubGOjd/IyEZ57iK2bziEzgqAQJodr4iVpICJ/lENkIfc/xNESvmMZcaK+F7Nm1yNE1aqqbYBjvwv6cL2Kzl8VQSDAn+BCrSA0PQ/ttmOO9GEXW8Ql9eB+W150YRabwO6TfP3hxyXWVF2kwiAe463KiEOmE2ysyHmlkTZHzAv4Hyo7zhsgbfIw8Xpe9vhOJRCKRUAUuACaXZ9CWQcUwAAAAAElFTkSuQmCC"
                            alt="leaderboard"width="25" height="25">
                        <span class="side-menu__label"style="margin-left: 8px;">LeaderBoard</span>
                    </a>
                </li>

                {{-- ?? setting slide  --}}
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 512 512">
                            <path
                                d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z" />
                        </svg>
                        <span class="side-menu__label">Settings</span><i class="angle fa fa-angle-right"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('profile.setting') }}" class="slide-item">Profile Settings</a></li>
                        <li><a href="{{ route('system.index') }}" class="slide-item">System Settings</a></li>
                        {{-- <li><a href="{{ route('mail.setting') }}" class="slide-item">Mail Settings</a></li> --}}
                        {{-- <!-- <li><a href="{{ route('stripe.index') }}" class="slide-item">Stripe Settings</a></li> --> --}}

                        {{-- <li>
                            <a href="{{ route('dynamic_page.index') }}"
                                class="slide-item {{ request()->is('admin/dynamic-page*') ? 'active' : '' }}">Dynamic
                                Page Settings
                            </a>
                        </li> --}}
                    </ul>
                </li>





            </ul>

            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </div>
</div>



{{-- <li class="slide {{ request()->is('admin/dynamic*') ? 'active is-expanded' : '' }}">
    <a class="side-menu__item {{ request()->is('admin/dynamic*') ? 'active is-expanded' : '' }}"
        data-bs-toggle="slide" href="{{ route('dynamic.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <path d="M3 15h18v-2H3v2z"></path>
        </svg>
        <span class="side-menu__label">Dynamic Page</span>
    </a>
</li>

<hr>

<li class="slide {{ request()->is('admin/settings*') ? 'active is-expanded' : '' }}">
    <a class="side-menu__item {{ request()->is('admin/settings*') ? 'active is-expanded' : '' }}"
        data-bs-toggle="slide" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 512 512">
            <path
                d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z" />
        </svg>
        <span class="side-menu__label">Settings</span><i class="angle fa fa-angle-right"></i>
    </a>

    <ul class="slide-menu">
        <li><a href="{{ route('profile.setting') }}" class="slide-item">Profile Settings</a></li>
        <li><a href="{{ route('system.index') }}" class="slide-item">System Settings</a></li>
        <li><a href="{{ route('mail.setting') }}" class="slide-item">Mail Settings</a></li>
        <li><a href="{{ route('stripe.index') }}" class="slide-item">Stripe Settings</a></li>
    </ul>
</li>
</ul> --}}
