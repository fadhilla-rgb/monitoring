<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
  </head>
  <body>
    <nav>
        <div class="py-4 px-8" >
            <img src="https://img.pikbest.com/png-images/20241003/a-fish-logo_10924291.png!sw800" alt="" class="w-16 h-16">
        </div>
    </nav>

    <main class="p-8" >
        <h1 class="font-bold text-2xl" >Monitoring system</h1>
        <div class="flex space-x-8 mt-10" >
            {{-- card --}}
            <div class="rounded-2xl bg-gray-400 py-4 px-8" >
                <h1>Kolam 1</h1>
            </div>
            <div class="rounded-2xl  bg-gray-400 py-4 px-8" >
                <h1>Kolam 2</h1>
            </div>
        </div>
    </main>
  </body>
</html>