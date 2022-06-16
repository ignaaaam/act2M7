<?php require('partials/head.php'); ?>
<div class="ml-4 my-4   flex justify-start items-center">
    <p class="w-[250px] flex justify-center bg-blue-500 py-2 px-4 rounded-lg">Bienvenido, <?= $_SESSION['username'] ?? 'User'; ?></p>
</div>
<div class="container mx-auto my-4 bg-blue-700 rounded-2xl text-white">
    <div class="p-4">
        <h2>Mis listas</h2>
        <table class="p-4 border-spacing-4">
            <tr>
                <th class="px-2">ID</th>
                <th class="px-2">Nombre de la lista</th>
            </tr>
            <?php foreach ($lists as $list) { ?>
                <tr>
                    <td class="px-2"><?= $list->id; ?></td>
                    <td class="px-2"><?= $list->list_name; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <div class="p-4">
        <h3>Mis tareas:</h3>
        <table>
            <tr>
                <th class="px-2">ID Tarea</th>
                <th class="px-2">Nombre de la tarea</th>
                <th class="px-2">ID Lista</th>
            </tr>
            <?php foreach ($tasks as $task) { ?>
                <tr>
                    <td class="px-2"><?= $task->id; ?></td>
                    <td class="px-2"><?= $task->name; ?></td>
                    <td class="px-2"><?= $task->list_id; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<div class="container mx-auto my-4 bg-blue-700 rounded-2xl text-white">
    <div class="flex items-center justify-center">
        <div class="p-4">
            <h3 class="font-bold mb-2">Crear una lista</h3>
            <form action="list/create" method="post">
                <input class="mb-4 text-black" type="text" name="list_name" placeholder="Nombre de lista"><br>
                <button class="border-2 border-blue-300 py-1 px-4 rounded-xl transition-transform hover:-translate-y-1" type="submit">Crear lista</button>
            </form>
        </div>

        <div class="p-4">
            <h3 class="font-bold mb-2">Crear una tarea</h3>
            <form action="task/create" method="post">
                <input class="border border-gray-300 mb-2 text-black" type="text" name="task_name" placeholder="Nombre de tarea"><br>
                <input class="mb-4 text-black" type="text" name="list_id" placeholder="ID lista"><br>
                <button class="border-2 border-blue-300 py-1 px-4 rounded-xl transition-transform hover:-translate-y-1" type="submit">Crear tarea</button>
            </form>
        </div>
    </div>
</div>


<?php require('partials/footer.php'); ?>