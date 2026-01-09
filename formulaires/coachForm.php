<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $nationalite = $_POST['nationalite'];
    $style_c = $_POST['style_c'];
    $annes_ex = $_POST['annes_ex'];
    $salary = $_POST['salary'];
    $equipe_id = $_POST['equipe_id'];
    $coachClass -> create($name,$email,$nationalite,$style_c,$annes_ex,$salary,$equipe_id,$connection);
    header("location:../admindashboard.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Coach</title>
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
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
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
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #0f172a;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
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
            background: #451a03;
            border: 1px solid #f59e0b;
            color: #fbbf24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }

        .info-text {
            background: #3f2609;
            border-left: 3px solid #f59e0b;
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
                <h1>Ajouter un Coach</h1>
                <p>Formulaire d'ajout de nouveau coach dans la base de données</p>
            </div>

            <div class="success" id="successMsg">
                ✓ Coach ajouté avec succès!
            </div>

            <div class="info-text">
                Les champs marqués d'un * sont obligatoires. Les années d'expérience doivent être un nombre positif.
            </div>

            <form id="coachForm" method="POST" action="coachForm.php">
                <div class="form-group">
                    <label for="name">Nom du Coach *</label>
                    <input type="text" id="name" name="name" placeholder="Ex: Carlo Ancelotti" required>
                    <div class="error" id="nameError"></div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" placeholder="Ex: coach@email.com" required>
                        <div class="error" id="emailError"></div>
                    </div>

                    <div class="form-group">
                        <label for="nationalite">Nationalité *</label>
                        <input type="text" id="nationalite" name="nationalite" placeholder="Ex: Italie" required>
                        <div class="error" id="nationaliteError"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="style_c">Style de Coaching *</label>
                        <input type="text" id="style_c" name="style_c" placeholder="Ex: Défensif" required>
                        <div class="error" id="style_cError"></div>
                    </div>

                    <div class="form-group">
                        <label for="annes_ex">Années d'Expérience *</label>
                        <input type="number" id="annes_ex" name="annes_ex" placeholder="Ex: 25" min="0" required>
                        <div class="error" id="annes_exError"></div>
                    </div>
                    <div class="form-group">
                        <label for="salary">Salary *</label>
                        <input type="number" id="salary" name="salary" placeholder="Ex: 25" min="0" required>
                        <div class="error" id="salaryError"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="equipe_id">ID de l'Équipe *</label>
                    <input id="equipe_id" name="equipe_id" required>
                    <div class="error" id="equipe_idError"></div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-submit">Ajouter le Coach</button>
                    <button type="reset" class="btn-reset">Réinitialiser</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const form = document.getElementById('coachForm');
        const successMsg = document.getElementById('successMsg');
        form.addEventListener('submit', function(e) {
                // Show success message
                successMsg.style.display = 'block';
            }
        );
    </script>
</body>
</html>
