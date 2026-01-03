<?php 
require_once "../equipe.php" ;
require_once "../config.php" ;
require_once "../joueur.php" ;
require_once "../FinancialEngine.php" ;
require_once "../transfert.php" ;
if($_SERVER['REQUEST_METHOD']=="POST"){
    $checkJoueur = $joueurClass -> search("joueur",$_POST['joueur_id'],$connection);
    $checkEquipeA = $teamClass -> search("equipe",$_POST['equipe_a'],$connection);
    $checkEquipeB = $teamClass -> search("equipe",$_POST['equipe_b'],$connection);
    if($checkJoueur && $checkEquipeA && $checkEquipeB){
        $budget = $joueurClass -> transfert($checkJoueur[0] , $checkEquipeA[0] , $checkEquipeB[0],$connection);
        $resault = $finalClass -> checkSolvabilité($budget,$_POST['montant']);
        if($resault == false){
            $state = "pendeng";
            $transfertClass -> Playerinsertion($checkJoueur[0],$checkEquipeA[0],$checkEquipeB[0],$state,$connection);
        }
        else{
            $state = "Completed";
            $transfertClass -> Playerinsertion($checkJoueur[0],$checkEquipeA[0],$checkEquipeB[0],$state,$connection);
            $transfertClass -> Alloperation($budget,$resault);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Transfer - Sports Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 2px solid #4f46e5;
            border-radius: 12px;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(79, 70, 229, 0.3);
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h1 {
            color: #4f46e5;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #94a3b8;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #e2e8f0;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        select, input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #334155;
            border-radius: 8px;
            background-color: #0f172a;
            color: #e2e8f0;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        select:focus, input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .error {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .error.show {
            display: block;
        }

        .form-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 30px;
        }

        button {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.4);
        }

        .btn-reset {
            background: #334155;
            color: #e2e8f0;
        }

        .btn-reset:hover {
            background: #475569;
        }

        .success-message {
            background: #10b981;
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }

        .success-message.show {
            display: block;
        }

        input[type="datetime-local"] {
            font-family: inherit;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>Add New Transfer</h1>
            <p>Transfer operation</p>
        </div>

        <div class="success-message" id="successMessage">
            Transfer added successfully !
        </div>

        <form id="transferForm" method="POST">
            <div class="form-group">
                <label for="joueur_id ">Player id *</label>
                <input type="text" id ="joueur_id" name="joueur_id" placeholder="Enter player id " required>
                <div class="error" id="joueur_id-error">Please enter a valid player id</div>
            </div>


            <div class="form-row">
                <div class="form-group">
                    <label for="equipe_a">From Team ID (Source) *</label>
                    <input type="number" id="equipe_a" name="equipe_a" placeholder="Enter team ID" required>
                    <div class="error" id="equipe_a-error">Please enter source team ID</div>
                </div>

                <div class="form-group">
                    <label for="equipe_b">To Team ID (Destination) *</label>
                    <input type="number" id="equipe_b" name="equipe_b" placeholder="Enter team ID" required>
                    <div class="error" id="equipe_b-error">Please enter destination team ID</div>
                </div>
            </div>
             <div class="form-group">
                <label for="montant ">Transfert montant *</label>
                <input type="number" id ="montant" name="montant" placeholder="Enter the price " required>
                <div class="error" id="montant_id-error">Please enter a valid player name</div>
            </div>


            <div class="form-actions">
                <button type="submit" class="btn-submit">Add Transfer</button>
                <button type="reset" class="btn-reset">Clear Form</button>
            </div>
        </form>
    </div>
</body>
</html>
