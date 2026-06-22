<nav class="bg-gray-900 shadow">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="flex items-center justify-between h-16">
            
            <!-- Logo -->
            <a href="<?php echo WEBROOT; ?>/wallet/index" class="text-white font-bold text-lg">Gestion Wallet</a>

            <!-- Liens -->
            <div class="flex items-center gap-6">
                <a href="<?php echo WEBROOT; ?>/wallet/index" 
                   class="text-gray-300 hover:text-white transition text-sm font-medium">
                    Wallets
                </a>
            </div>

            <!-- Déconnexion -->
            <a href="<?php echo WEBROOT; ?>/auth/logout" 
               class="text-sm text-red-400 hover:text-red-300 transition font-medium">
                Déconnexion
            </a>

        </div>
    </div>
</nav>