@extends('backend.app')

@section('title', 'Dashboard')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row ">
        <div class="col-lg-4 col-sm-12 col-md-4 col-xl-3">
            <div class="overflow-hidden card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 fw-semibold">{{ $task }}</h3>
                            <p class="mb-0 text-muted fs-13">Total Task</p>
                        </div>
                        <div class="col-auto col top-icn dash">
                            <div class="counter-icon bg-primary dash ms-auto box-shadow-primary">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAD1ElEQVR4nO2ZSVMTaRyHOTgXy9PM1fNMFbI7buB21PKiNVcvimyu4PoZHL1x4jCllqKySXaSdCedlUAUmKgQQDIYY40VIHF5P8DP6r/doNiJlu9LRy3equeWpJ+nk+ofVZSVrZ+f8HR1df1y857l+s0e++KtXsfi7X7nNUVRNpT9KOdOn/Pv7gEX7j5w496gB/ctXvRYvFdLIjNyZf+h2OV9L2NX9mP48j5D7vQ70T0w9KmwVUKfw1ffa1N29zsVDLgCeDAUxKA7BIsnAqs3ivCF3Z8Q0jnfgFBHQyZ8oeEgd0D00t7MauGoyqW9y9y3etFjk9Br96HP4Ycu7Lr7zxFn942/dGGbPAy7LwanfxQuJf659EcEzzcg0FH/gjtAl84m42CMGbJyh0MYdIdh9UZgk6Kwy8Nw+EaWhYcCD+EOPoInNAZveKLg572aHEGwo54Q8Q3QXS50MZUV4VgB4XF4IxOQov9CHk7AF3sM/8jTop8Z6KgnTAkIx5+sCIfG4AmvFn5CwsroJILxKYQeJjE+NV88oH0XwR0QubgHKsUuthYo7buIHzfg3E6COyB8cQ89LcwO8J/bSfAHaI850wPO7iC4A/RntNkBvrM7CP4AbVRKESCf2c4foMqrg2J2gHxmu6AAbVBEymXHEhg/1o6MQyoaIJ3exh+gL6Io+Xw+j+fTM4gfPYXRw8eQccqGr1PlxQRogyJKPpVKYW5uDvPT0xShfhOFAryn/uQP0BeRV/7dKwnp1ARmZ2eX+W8qST8no9er8kIC9EHhk5eRC2xCPvQb5ucmMDMzQwFLS0sF36PKe76HAF0+5y/7QPBXzD97hFwuV/R9npNbCe4AfVCEyKsENuLt/64vvtd9citRsgAeeaYGtNUR3AH6oJgpzxjDUFsdYXqACHmmBrTWEtwB+qCYKc8Yg6u1ljAtQKQ8UwNaagjuAH1QzJRnjMHZUkOsecBayDM1oLma4A7QB8XoIm/fvMZi5PdV8pvozwYeecYYHM3VxJoGLCwsIJUMYiG4WdidZ3pAUxXBHUCL2FZneBFZlpFMJvFsUsFi5A9h8owx2JuqCP4AbRGNLtLZ2QlJkpDNZvHmdV6YPFMDTlQS3AG0iK21QuW+BtuJSoI/QBuUkgQ0VvAH0CK21JgeYG2sIPgDtEEpRYDl+Bb+AFrE5mrTAyzHtwgK0AYlnU6bJp9OPxcXoC9iLBYzFYuwAG1Q4u4+JBIJUxh19YgLsDVVZWgVtWGxGaE9MT5Dk/h2yvn/yWdrqjxobazIrJY2FNaeHGIof2FtLD/AHbB+1s9Pft4D7SFFTRaWQjEAAAAASUVORK5CYII="
                                    alt="task--v1"width="30" height="30">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-4 col-xl-3">
            <div class="overflow-hidden card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 fw-semibold">{{ $users }}</h3>
                            <p class="mb-0 text-muted fs-13">Total User</p>
                        </div>
                        <div class="col-auto col top-icn dash">
                            <div class="counter-icon bg-secondary dash ms-auto box-shadow-secondary">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFA0lEQVR4nN3W609TZxwH8GZvtmT/wa5vd4l/wZb4Ziq9g8bEIRMWYzaopVx64TKDomMTI8LUltPSgy3ltAwiCChCewr2dkoYQ4FtsnHTIVTuSK9c+lueE8Zgg1HktCx7km/65Lnk+eR5znlOWaz/c9Glxh2sFvNVhEQ4bBDzX+hSOauGs/wFU4bQpfuSnVhQUPDKvsCqvoj7gMgQ9NRJjy72YrLV6cYrELDchLBdQ/8+MRVCU17iojFd6NZnH3o9pjidiHukWizwDtzKD4ftFQCOrYP6HFdSA0aJsCVmuFtpRz5EuMmG4m1hsCGrNjXUSo8G9Wm8oFEi7NSlcj+JKtAoEfb/pj8XjgQHG+K33IAR4jzUZCZ4q8S8rKjg9CL2odvy44v/dqywQ3xt14GQCHy4iH2AcWC1RHCrX6PY1e5N1hfD3N2STW19avkKIeHrGQcSkvins81XI8Yt3LsGtbJjUJOdAMPV59fb5++WAJEuGGccaBDzfUFSGRFuBD1v2QkwRF6E+cc3oFZxDJ6aCum+5Q4M9CJuiHGgTsRZQW/l3zFBUglzzSUwXlcEvWop3PnqBDQVnoSp3lKA2So6031lNBiNDbWrwHCWF2AcaDjLe4EuYYR6fvsytF5KAWNmPHwvPwZ3Cj6F1uLPocuQDZ7uq+uwjaHwdOhRZsFM01UwZsQ/YRxozBT2e25/S+8UQg1ZL8Ly88otMVtl8uE1qM89DqPEBQS0Mg6sEvPLHpVLV5vPJcKo/euIYbCWpQkcDOk8oEpEQb2II2UcWH+Bfakx/0TYIObB0kTkOwcbokvjQK3saLi+KI55YJuas0BkCOhFXgYHa8AaWTyYKzgLjAPNWs6c5bukPQM7sGQwa9lzjAMtOJegTJ8t7xVImZJWSJxbxTiQrOC8a8HZs2YNG8Iz+l3jwjN6QHPNOHv2Pn74bVY0SpuG874F5y6HJtS7BoYmNGDW8pbvY4ffY0WzWHUCarK/aNfA531F0K7jO1nRLm0V7DM/NCQv7hbY1ZDsbdVyTkcd2F558DUS53qmfr4c+Vfkp2/AgvMm7pXFvcqKRTFjcR+TlXzfwtBffwi2y/xgKZCVfG+rhv1RTHDryAoOl8R5MEQpYGXqn18W1DbkkgMaY9Gy2az9KG2aOOhqOAlkJQ/6zWkQeFZOB9VRW1dDEqAx+4L7E+jpz4dnPQp4eC8FOvRCOqiO2lBfTIEKzP6OXOlMz9NQrhwNNY4Wn+jLpyFbBfWhMWgsmiMtd4izbj5g/pKWl7nfUmAUkYNR/tK7A76aH6ehZTAAZJ0EHrWe2RbY23oGrHUZ9Fg0p7R5wKfAKH+OmqrOVLneZAQnVdkTZJjTpyZHl6y/r4DNA+t5MDoDJHEK3A0pMExlwHhvLh1Ud9cng4U4RY/ZOId8ugyYZTSkKHd5s5QOwZ5wMqUzO1/b6W18vLhpkU3IMT9YbQYgTafBjPPpoHq7vRpsY/5t5zX+sgh52k6vAnNlvvTO5VW4vfeHg9suYttj2kZCgNaQqhzCXT9zcpXT1zzgixrOtpamAS/IMadXdt3xRsTAHLXLiFlGg9HG2daiMo+E0IsT8VWiwFxB69jmFyKasY6tAFoTndzOx6t0ppc1/+qLFc62FnQFoXtyR2Cuxu2q6Z6OKc7mATB1T0Ouxm2P5PnztAwFYg5sGQxAjpp6tiNQpnL4pUoH7EdkKod/R+B/rfwBBuK/i4zrKkUAAAAASUVORK5CYII=" alt="user"width="30" height="30">                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-4 col-xl-3">
            <div class="overflow-hidden card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 fw-semibold">{{ $pending }}</h3>
                            <p class="mb-0 text-muted fs-13">Total Pending Task</p>
                        </div>
                        <div class="col-auto col top-icn dash">
                            <div class="counter-icon bg-info dash ms-auto box-shadow-info">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACVElEQVR4nO2ZPWsVQRSGn4uSGKwMKJooftUWBoSbm0IhsUsh6A9SxBgJAT8arZQ04r8wTVJHwY9osEn8qFXUmDgy8C4cwtXc3ezMTjb7wDRnd86Zd+bM7Nld2AO4RFtuaickFdyeF7KmGehUvRTAmMayWqTz7QT2g9vSbhUR0icx2cpU2VYlwo+pFGIdAC50nEZITlyzIj1S69T6UcKp9D22kD8K0DK2DyUIWTH+WrL5WMH4pCDHjO1ZCUKeGn9Dsn0MKWRRQcaN7VoJQq4Yf5dlWwgp5IaCPDG2/cCrHYhYAvYZf3OyXw8p5BSwCawDF4z9PPCtgIivwDnjZwT4pf1xhsDc0yDeAseN/SrwO4eIn8Ck6X8CeKdrd4nAgNLBqaD0JXbGJeBLDyJ8v7bpN2aK0yXgAJEYBOYV2KfarAR6jgAPgY0uAtY124fMpMzKh78+L99R6dcgNkyq2Zewkyq93wCvdVAMm+sd9XHy4X15n5XRNqeW36SPgIP/ud+nzbSZgPfARRJhAJgxg/OrMNrlvlFdy1ZhxqRkEtRCSFt7YNemVv82m307ktjsg8DzHKvQ6+osAIeJhM/pl+brhn0gFsU+EF/E2jcPTCrZ58JO8eXOsnzfJzCn/1E0lsWIKRrPEpCbmrHHAWPMKYavBKK+WJXNhGL4WMH4rCBHA8YYivGq2+3jQ9m0Ynx8yMrx0LjQcRohOXHNivRIk1pVTlgfcEfnuau4rek3YKFfb9MJCHBb2lQRIVlZ3e2VNTYdszLJbuzg43F1E+ISa7mpjRB2E38B+fRsZUixgIIAAAAASUVORK5CYII=" alt="hourglass-sand-top--v1" width="30" height="30">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-4 col-xl-3">
            <div class="overflow-hidden card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 fw-semibold">{{ $approved }} </h3>
                            <p class="mb-0 text-muted fs-13">Total Approved Task</p>
                        </div>
                        <div class="col-auto col top-icn dash">
                            <div class="counter-icon bg-warning dash ms-auto box-shadow-warning">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAC60lEQVR4nO2Zz2tTQRDHH/46ePTHyR//hFjsKTcp7MrOOzyUelHRnqUQLb3k1noQW6glLf4HKW8GUvWi4NGW9qIogje1J/vj3Aj1yWxfAw0vyW7evk2EDAykDcn7fGd3ZmcnQTC0oQ0tt0W16KREGBWkpiWpWCB8lQh7ktQf7Qh7AuGLfo/U9K04vFGpVE4E/TZF6opEeCYRtiRBYufqlyA1OxaHl72Dj9Wii5JgWZBq2IMfd0GqIUhVZV1e8AIvSY1LUrt5wTOE7Ig4vFMY+LXlidMC4ZVrcNkqBGGJn+UUXtblWUHqbdHw8sgR3vAz3UXeJzw1RbyLatGZ3AJ8bBvZPi+q+eDj8G6/4GXT1e2e4AHhvEDYHgABuz2VWK7zPkHvvR9vv5UQFq3g+XR0cUiZ+uTHB8nawYtk/vtku1xoyLq8ah59bg88w28m89o7iJg1gucmi/sUH/DltUfJ+sFcE56d/76ftZ0QtrhpNIn+aD8iv5nCs6gOuTDSVcBhS1ws/JP1h5mRL3eAT1dhymQFcCDhSQtY6b4C+uIxgPCkBXzuvgIWrXKn2m2asGVT+MMc2DbJAaP6//zbY2OA3JGn5grsOxHA8KYgzuDJUEC3LcQ12hTIKTyZbiGDJM6q4Rt/55KpjYnC4KVxEhuW0U4iCoEn0zJqcZC1qyxZ/2NRueBJ90NPuwrgoZPNl2athPPIU+pxeN2omRMIP12IcAkvEH4YT/O4dbV9QKsIp5EndjUTFH2hORLhHB5hX6yKS8YC0lWo9vIwTlYXCSuPR38hsLWbtejcIFzqBamdnuemPKvsuwAMo57gmyIQlvoY/ZdBXuN7qEAg/wLU69KH0qnAhfGgVQ9c/UV+1dlwt2XIW/WxbUquIp9lPKsspjqp37kT1nJuusgHTG5w5O9QC1y2A9/GpyO3Hba9k94q+jNqxvqELcLSBnCE5zbcs/PFg2926Q94Df0a4RO/xy0xd5UD8TPr0IYW/P/2D5+LFXPdole1AAAAAElFTkSuQmCC" alt="ok--v1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-4 col-sm-12 col-md-4 col-xl-3">
            <div class="overflow-hidden card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 fw-semibold">{{ $approved }} </h3>
                            <p class="mb-0 text-muted fs-13">Leaderboard User Count</p>
                        </div>
                        <div class="col-auto col top-icn dash">
                            <div class="counter-icon bg-warning dash ms-auto box-shadow-warning">
                                <svg fill="#000000" width="800px" height="800px" viewBox="0 0 24 24"
                                    id="approved-file-2" data-name="Flat Line" xmlns="http://www.w3.org/2000/svg"
                                    class="icon flat-line">
                                    <path id="secondary"
                                        d="M10,20.5A6.5,6.5,0,0,1,16.5,14a4.19,4.19,0,0,1,.5,0V5H15V3H4A1,1,0,0,0,3,4V20a1,1,0,0,0,1,1h6A4.19,4.19,0,0,1,10,20.5Z"
                                        style="fill: rgb(44, 169, 188); stroke-width: 2;"></path>
                                    <polyline id="primary" points="15 19 17 21 21 17"
                                        style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                    </polyline>
                                    <path id="primary-2" data-name="primary"
                                        d="M11,21H4a1,1,0,0,1-1-1V4A1,1,0,0,1,4,3H15l2,2V15"
                                        style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                    </path>
                                    <path id="primary-3" data-name="primary" d="M7,13h3M7,9h6m2-6V5h2Z"
                                        style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    {{-- <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Polar Chart</h3>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="chartPolar" class="h-275"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
