<?php require('partials/head.php'); ?>
    <div class="credentials-box">
        <form action="#" class=" credentials-form ml-4 mt-6 w-10/12 h-auto bg-indigo-700 rounded-lg">
        <h1 class="p-6 font-bold text-2xl text-white">Registro</h1>
            <label for="email" class="sr-only">Email address:</label>
            <input class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email..." type="email" name="" id="email"><br>
            <label class="sr-only" for="password">Password:</label>
            <input class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" type="password" name="password" id="password" placeholder="Password..."><br>
            <label class="sr-only" for="password-confirmation">Repeat Password:</label>
            <input class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" type="password" name="password-confirmation" id="password" placeholder="Confirm password...">
            <label class="text-white ml-4 mr-4" for="role">Role:</label>
            <select class="my-8 rounded-lg bg-indigo-500 border rounded-md text-white p-2" name="role" id="role">
            <?php foreach($roles as $role):?>
                <option class="m-4"><?php echo $role->role ;?></option>
            <?php endforeach; ?>
            </select><br>

            <button type="button" class="flex mx-auto mt-2 mb-4 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg cursor-pointer border border-white-100 border-opacity-50">Registro</button>

            <p class="pb-6"><a class="m-4  hover:text-indigo-100 text-indigo-300" href="/login">Ya tienes cuenta? Logueate!</a></p>
        </form>
    </div>
<?php require('partials/footer.php'); ?>