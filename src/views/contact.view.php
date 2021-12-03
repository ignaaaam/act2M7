<?php require('partials/head.php'); ?>

    
<div class="credentials-box">
    <form class="credentials-form ml-4 mt-6 w-3/4 bg-indigo-700 rounded-lg" action="#" method="post">
        <h1 class="p-6 font-bold text-2xl text-white">Contact Page</h1>
        <label class="sr-only"  for="email">Email:</label>    
        <input class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" type="email" name="email" id="contact-email" placeholder="Email...">
        <br>
        <label class="sr-only"  for="name">Name:</label>    
        <input class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" type="text" name="name" id="contact-name" placeholder="Name...">
        <br>
        <label class="sr-only"  for="message">Message:</label>    
        <textarea class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm mb-8" rows="6" name="message" id="contact-message" placeholder="Enter your message..."></textarea>
        <button type="button" class="flex mx-auto mt-2 mb-4 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg cursor-pointer border border-white-100 border-opacity-50">Enviar</button>
        
    </form>
</div>
<?php require('partials/footer.php'); ?>