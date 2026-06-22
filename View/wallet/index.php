<?php require_once(dirname(__DIR__)) ."/layout/header.partial.php"?>

<body class="bg-gray-100 min-h-screen">
    <header>
        <?php require_once(dirname(__DIR__)) ."/layout/nav.partial.php"?>
    </header>

    <main class="container mx-auto px-4 pt-10 max-w-7xl">
        <?php
            $errors  = $viewData['errors'] ?? [];
            $success = $viewData['success'] ?? null;
        ?>

        <!-- Message succès -->
        <?php if($success): ?>
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            <?php echo $success ?>
        </div>
        <?php endif ?>

        <!-- Message erreur global -->
        <?php if(!empty($errors)): ?>
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <?php foreach($errors as $error): ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
        <?php endif ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <!-- Partie 1 : Créer Wallet -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-base font-bold text-gray-800 mb-4">Créer un Wallet</h2>
                <form action="<?php echo WEBROOT ?>/wallet/creer" method="POST" class="space-y-3">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Code</label>
                        <input type="text" name="code"
                            class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-800
                                <?php echo isset($errors['code']) ? 'border-red-500 bg-red-50' : 'border-gray-300' ?>"/>
                        <?php if(isset($errors['code'])): ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo $errors['code'] ?></p>
                        <?php endif ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                        <input type="text" name="nom"
                            class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-800
                                <?php echo isset($errors['nom']) ? 'border-red-500 bg-red-50' : 'border-gray-300' ?>"/>
                        <?php if(isset($errors['nom'])): ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo $errors['nom'] ?></p>
                        <?php endif ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                        <input type="text" name="prenom"
                            class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-800
                                <?php echo isset($errors['prenom']) ? 'border-red-500 bg-red-50' : 'border-gray-300' ?>"/>
                        <?php if(isset($errors['prenom'])): ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo $errors['prenom'] ?></p>
                        <?php endif ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                        <input type="text" name="telephone"
                            class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-800
                                <?php echo isset($errors['telephone']) ? 'border-red-500 bg-red-50' : 'border-gray-300' ?>"/>
                        <?php if(isset($errors['telephone'])): ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo $errors['telephone'] ?></p>
                        <?php endif ?>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Solde initial</label>
                        <input type="number" name="solde" value="0" min="0"
                            class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-800
                                <?php echo isset($errors['solde']) ? 'border-red-500 bg-red-50' : 'border-gray-300' ?>"/>
                        <?php if(isset($errors['solde'])): ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo $errors['solde'] ?></p>
                        <?php endif ?>
                    </div>

                    <button type="submit"
                        class="w-full bg-gray-900 hover:bg-gray-700 text-white text-sm font-semibold py-2 rounded-lg transition">
                        Créer
                    </button>
                </form>
            </div>

            <!-- Partie 2 : Dépôt et Retrait -->
            <div class="md:col-span-2 space-y-6">

                <!-- Dépôt -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-base font-bold text-gray-800 mb-4">Faire un Dépôt</h2>
                    <form action="<?php echo WEBROOT ?>/wallet/depot" method="POST" class="flex gap-4 items-end">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                            <input type="text" name="telephone_depot"
                                class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-800
                                    <?php echo isset($errors['depot']) ? 'border-red-500 bg-red-50' : 'border-gray-300' ?>"/>
                            <?php if(isset($errors['depot'])): ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo $errors['depot'] ?></p>
                            <?php endif ?>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Montant (CFA)</label>
                            <input type="number" name="montant_depot" min="1"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-800"/>
                        </div>
                        <button type="submit"
                            class="bg-green-700 hover:bg-green-600 text-white text-sm font-semibold px-6 py-2 rounded-lg transition">
                            Déposer
                        </button>
                    </form>
                </div>

                <!-- Retrait -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-base font-bold text-gray-800 mb-4">Faire un Retrait</h2>
                    <form action="<?php echo WEBROOT ?>/wallet/retrait" method="POST" class="flex gap-4 items-end">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                            <input type="text" name="telephone_retrait"
                                class="w-full px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-800
                                    <?php echo isset($errors['retrait']) ? 'border-red-500 bg-red-50' : 'border-gray-300' ?>"/>
                            <?php if(isset($errors['retrait'])): ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo $errors['retrait'] ?></p>
                            <?php endif ?>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Montant (CFA)</label>
                            <input type="number" name="montant_retrait" min="1"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-800"/>
                        </div>
                        <button type="submit"
                            class="bg-red-700 hover:bg-red-600 text-white text-sm font-semibold px-6 py-2 rounded-lg transition">
                            Retirer
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <!-- Partie 3 : Transactions -->
        <div class="bg-white rounded-2xl shadow overflow-hidden mb-10">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Liste des Transactions</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3">Code</th>
                            <th class="px-6 py-3">Titulaire</th>
                            <th class="px-6 py-3">Téléphone</th>
                            <th class="px-6 py-3">Montant</th>
                            <th class="px-6 py-3">Type</th>
                            <th class="px-6 py-3">Date & Heure</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php
                            $transactions = $viewData['transactions'] ?? [];
                            foreach($transactions as $transaction):
                        ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-3 font-medium"><?php echo $transaction->getCode() ?></td>
                            <td class="px-6 py-3"><?php echo $transaction->getNom() . ' ' . $transaction->getPrenom() ?></td>
                            <td class="px-6 py-3"><?php echo $transaction->getTelephone() ?></td>
                            <td class="px-6 py-3"><?php echo number_format($transaction->getMontant(), 0, ',', ' ') ?> CFA</td>
                            <td class="px-6 py-3">
                                <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium
                                    <?php echo $transaction->getType() == 'DEPOT' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                                    <?php echo $transaction->getType() ?>
                                </span>
                            </td>
                            <td class="px-6 py-3"><?php echo $transaction->getDateHeure() ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <?php require_once(dirname(__DIR__)) ."/layout/footer.partial.php"?>
</body>
</html>