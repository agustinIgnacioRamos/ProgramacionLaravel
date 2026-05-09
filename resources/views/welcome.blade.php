<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FARS | {{ config('app.name', 'ProgramacionLaravel') }}</title>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="fars-page">
        <main class="fars-shell">
            <section class="fars-hero" aria-labelledby="fars-title">
                <p class="fars-kicker">Equipo de desarrollo</p>

                <h1 id="fars-title">FARS</h1>

                <p class="fars-lead">
                    Roman hace los requerimientos.
                </p>
            </section>

            <section class="fars-stage" aria-label="Identidad FARS">
                <div class="fars-wordmark" aria-hidden="true">
                    <span>F</span>
                    <span>A</span>
                    <span>R</span>
                    <span>S</span>
                </div>

                <div class="fars-signal" aria-hidden="true">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <p>Primer deploy compartido del equipo.</p>
            </section>

            <section class="fars-team" aria-labelledby="team-title">
                <div>
                    <p class="fars-section-label">Desarrolladores</p>
                    <h2 id="team-title">Dream Team</h2>
                </div>

                <div class="fars-members">
                    <article>
                        <span>F</span>
                        <h3>Francisca Ronco</h3>
                    </article>

                    <article>
                        <span>A</span>
                        <h3>Agustin Ramos</h3>
                    </article>

                    <article>
                        <span>R</span>
                        <h3>Roman Gallop</h3>
                    </article>

                    <article>
                        <span>S</span>
                        <h3>Sofia Veronesi</h3>
                    </article>
                </div>
            </section>
        </main>
    </body>
</html>
