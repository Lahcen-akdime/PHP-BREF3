<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Joueur</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 600px;
        }

        .form-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
        }

        .form-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .form-header h1 {
            color: #f1f5f9;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #94a3b8;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #cbd5e1;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #334155;
            border-radius: 8px;
            background: #0f172a;
            color: #f1f5f9;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #06b6d4;
            box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
        }

        input::placeholder {
            color: #64748b;
        }

        option {
            background: #1e293b;
            color: #f1f5f9;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        button {
            flex: 1;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: #0f172a;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(6, 182, 212, 0.3);
        }

        .btn-reset {
            background: #334155;
            color: #f1f5f9;
        }

        .btn-reset:hover {
            background: #475569;
        }

        .error {
            color: #ff6b6b;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .success {
            background: #064e3b;
            border: 1px solid #10b981;
            color: #10b981;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }

        .info-text {
            background: #1e3a4c;
            border-left: 3px solid #06b6d4;
            padding: 12px;
            border-radius: 4px;
            color: #cbd5e1;
            font-size: 13px;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <div class="form-header">
                <h1>Ajouter un Joueur</h1>
                <p>Formulaire d'ajout de nouveau joueur dans la base de données</p>
            </div>

            <div class="success" id="successMsg">
                ✓ Joueur ajouté avec succès!
            </div>

            <div class="info-text">
                Les champs marqués d'un * sont obligatoires. Tous les ID doivent être des nombres positifs.
            </div>

            <form id="playerForm">
                <div class="form-group">
                    <label for="name">Nom du Joueur *</label>
                    <input type="text" id="name" name="name" placeholder="Ex: Kylian Mbappé" required>
                    <div class="error" id="nameError"></div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="role">Rôle *</label>
                        <input type="text" id="role" name="role" placeholder="Ex: Attaquant" required>
                        <div class="error" id="roleError"></div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" placeholder="Ex: joueur@email.com" required>
                        <div class="error" id="emailError"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nationalite">Nationalité *</label>
                        <input type="text" id="nationalite" name="nationalite" placeholder="Ex: France" required>
                        <div class="error" id="nationaliteError"></div>
                    </div>

                    <div class="form-group">
                        <label for="valeur_m">Valeur Marchande (€) *</label>
                        <input type="number" id="valeur_m" name="valeur_m" placeholder="Ex: 150000000" min="0" required>
                        <div class="error" id="valeur_mError"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="equipe_id">ID de l'Équipe *</label>
                    <select id="equipe_id" name="equipe_id" required>
                        <option value="">-- Sélectionner une équipe --</option>
                        <option value="1">Équipe 1</option>
                        <option value="2">Équipe 2</option>
                        <option value="3">Équipe 3</option>
                        <option value="4">Équipe 4</option>
                        <option value="5">Équipe 5</option>
                    </select>
                    <div class="error" id="equipe_idError"></div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-submit">Ajouter le Joueur</button>
                    <button type="reset" class="btn-reset">Réinitialiser</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const form = document.getElementById('playerForm');
        const successMsg = document.getElementById('successMsg');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear previous errors
            document.querySelectorAll('.error').forEach(el => el.style.display = 'none');
            successMsg.style.display = 'none';

            // Validate form
            let isValid = true;
            const formData = new FormData(form);

            // Validation rules
            const name = formData.get('name').trim();
            if (name.length < 2) {
                showError('nameError', 'Le nom doit contenir au moins 2 caractères');
                isValid = false;
            }

            const role = formData.get('role').trim();
            if (role.length < 2) {
                showError('roleError', 'Le rôle doit contenir au moins 2 caractères');
                isValid = false;
            }

            const email = formData.get('email').trim();
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showError('emailError', 'Email invalide');
                isValid = false;
            }

            const nationalite = formData.get('nationalite').trim();
            if (nationalite.length < 2) {
                showError('nationaliteError', 'La nationalité doit contenir au moins 2 caractères');
                isValid = false;
            }

            const valeur_m = formData.get('valeur_m');
            if (isNaN(valeur_m) || valeur_m < 0) {
                showError('valeur_mError', 'La valeur marchande doit être un nombre positif');
                isValid = false;
            }

            const equipe_id = formData.get('equipe_id');
            if (!equipe_id) {
                showError('equipe_idError', 'Sélectionnez une équipe');
                isValid = false;
            }

            if (isValid) {
                // Prepare data for database insert
                const playerData = {
                    name: name,
                    role: role,
                    email: email,
                    nationalite: nationalite,
                    valeur_m: parseInt(valeur_m),
                    equipe_id: parseInt(equipe_id)
                };

                console.log('[v0] Données du joueur prêtes pour insertion:', playerData);

                // Show success message
                successMsg.style.display = 'block';
                form.reset();

                // Here you would normally send the data to your backend
                // fetch('/api/players/add', {
                //     method: 'POST',
                //     headers: { 'Content-Type': 'application/json' },
                //     body: JSON.stringify(playerData)
                // })
            }
        });

        function showError(elementId, message) {
            const errorEl = document.getElementById(elementId);
            errorEl.textContent = message;
            errorEl.style.display = 'block';
        }
    </script>
</body>
</html>
