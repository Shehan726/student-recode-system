<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    @livewire('sample')
    <div class="bg-white p-6 rounded-lg shadow-md w-96">    
        <h2 class="text-xl font-bold mb-4 text-center">Student Registration</h2>
        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data" class="max-w-lg mx-auto p-4 bg-white rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="first_name" class="block text-sm font-semibold text-gray-700">First Name</label>
                <input type="text" name="first_name" placeholder="First Name" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="last_name" class="block text-sm font-semibold text-gray-700">Last Name</label>
                <input type="text" name="last_name" placeholder="Last Name" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" placeholder="Email" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="contact_no" class="block text-sm font-semibold text-gray-700">Phone</label>
                <input type="text" name="contact_no" placeholder="Phone" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="nic" class="block text-sm font-semibold text-gray-700">NIC</label>
                <input type="text" name="nic" placeholder="NIC" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-semibold text-gray-700">Class Type</label>
                    <select name="type" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>Select Class Type</option>
                        <option value="Class A">Class A</option>
                        <option value="Class B">Class B</option>
                    </select>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-semibold text-gray-700">Address</label>
                <input type="text" name="address" placeholder="Address" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="date_of_birth" class="block text-sm font-semibold text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" placeholder="Date of Birth" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-semibold text-gray-700">Profile Image</label>
                <input type="file" name="image" accept="image/*" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="pdf" class="block text-sm font-semibold text-gray-700">Upload PDF</label>
                <input type="file" name="pdf" accept="application/pdf" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Register</button>
            </div>
        </form>


    </div>
</body>
</html>

{{-- <!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('c99c5c61260794cda167', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>
<body>
  {{-- <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body> --}}