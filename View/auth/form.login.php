<?php require_once(dirname(__DIR__)) ."/layout/header.partial.php"?>
<body class="bg-gray-100 min-h-screen">
    <header></header>
    <main class="flex items-center justify-center min-h-screen py-10">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
            <?php 
                $errors = $viewData['errors'] ?? [];
            ?>

            <?php if(isset($errors['error_connection'])): ?>
                <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-lg" role="alert">
                    <?php echo $errors['error_connection'] ?>
                </div>
            <?php endif ?>

            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Connexion</h2>

            <form action="<?php echo WEBROOT; ?>/auth/login" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Login</label>
                    <input
                        type="text"
                        name="login"
                        value=""
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition"
                        placeholder="Votre identifiant"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input
                        type="password"
                        name="password"
                        value=""
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition"
                        placeholder="Votre mot de passe"
                    />
                </div>

                <div class="pt-2">
                    <button
                        type="submit"
                        class="w-full bg-gray-900 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200"
                    >
                        Se Connecter
                    </button>
                </div>
            </form>
        </div>
    </main>

    <?php require_once(dirname(__DIR__)) ."/layout/footer.partial.php"?>
</body>
</html>