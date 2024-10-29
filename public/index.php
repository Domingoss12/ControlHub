<?php
session_start();
//Check user as logged
if (isset($_SESSION['userToken'])) {
    header("Location: dashboard.php");
    exit();
}

$hiddenMessage = "hidden";
if (isset($_SESSION['showMessage'])) {
    $hiddenMessage = "";
    unset($_SESSION['showMessage']);
}
?>

<!DOCTYPE html>
<html lang="pt_PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicíar Sessão || ControlHub</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</head>

<body class="bg-[url('assets/Images/Background.svg')] bg-repeat">
    <!-- Credenctials incorrect warnning Start -->
    <div class="<?php echo $hiddenMessage; ?> fixed top-32 md:top-10 left-1/2 transform -translate-x-1/2 z-50" id="toast-warning" role="alert">
        <div class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                </svg>
                <span class="sr-only">Warning icon</span>
            </div>
            <div class="ms-3 text-sm px-2 font-normal">Nome de utilizador não encontrado ou incorreto!</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    </div>
    <!-- Credenctials incorrect warnning End -->

    <!-- Desktop Version Start -->
    <div class="hidden md:flex items-center justify-center h-screen">
        <div class="w-2/6 pb-10 pt-2 bg-gray-100 dark:bg-gray-800 rounded-xl shadow-2xl">

            <div class="flex items-center">
                <div class="flex items-center mx-auto m-4">
                    <img src="assets/Images/Logotipo.png" class="mr-3 h-6 sm:h-9" />
                    <span class="self-center md:text-3xl font-black whitespace-nowrap dark:text-white">ControlHub</span>
                </div>
            </div>
            <div class="h-3/4 flex items-center justify-center">
                <form class="w-4/5" method="post" action="../src/function/authUserUsername.php">
                    <div class="mb-5">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome de utilizador</label>
                        <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="username">
                    </div>
                    <div class="w-full flex items-center justify-center mt-4">
                        <button type="submit" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm w-15 sm:w-auto px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Continuar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Desktop Version End -->

    <!-- Mobile Version Start -->

    <div class="flex md:hidden items-center justify-center h-screen ">
        <div class="w-full h-full bg-gray-100 dark:bg-gray-800">
            <div class="flex items-center">
                <div class="flex items-center mx-auto m-4 mt-10 ">
                    <img src="assets/Images/Logotipo.png" class="mr-3 h-12" />
                    <span class="self-center text-4xl font-black whitespace-nowrap dark:text-white">ControlHub</span>
                </div>
            </div>
            <div class="h-3/4 flex items-center justify-center">
                <form class="w-full p-2" method="post" action="../src/function/authUserUsername.php">
                    <div class="mb-5">
                        <label for="username" class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white">Nome de utilizador</label>
                        <input type="text" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500 dark:focus:border-teal-500" placeholder="username">
                    </div>
                    <div class="w-full flex items-center justify-center mt-4">
                        <button type="submit" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-2xl w-15 sm:w-auto px-5 py-2.5 text-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Continuar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>