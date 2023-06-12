<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    Protect Db Package
    </title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.4/dist/tailwind.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap');
    body {
      font-family: 'Roboto Mono', monospace;
    }
  </style>
</head>

<body>
  <div class="bg-indigo-100 w-100 min-h-25"
  style="min-height: 40vh"

  >
    <img src="https://source.unsplash.com/1600x400/?nature,water"

    alt="Banner Image" class="w-full">
  </div>

  <div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-center mb-8">Welcome to Protect Db Package</h1>

    <div class="flex justify-center mb-8">
        <form action="{{ route('protect-db.protect' )}}" method="POST">
            @csrf
            <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                Protect Db
            </button>

        </form>
    </div>

    <ul class="list-disc list-inside">
        @foreach ($totalBackups as $backup)
        <li>{{ $backup }}</li>
                @endforeach
      <!-- Add more items as needed -->
    </ul>

{{ $totalBackups->links()  }}

  </div>

  @if (session()->has('message'))
    <div class="fixed bottom-0 right-0 bg-green-500 text-white py-2 px-4 rounded">
        {{ session('message') }}
    </div>
  @endif
</body>

</html>

