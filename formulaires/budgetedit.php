<?php
require_once "../AutoLoading/autoloading.php";
use Classes\equipe;
use Classes\dataBase;

$database = new dataBase();
$connection = $database -> getconnection() ;
$teamClass = new equipe($connection);
if($_SERVER['REQUEST_METHOD']=="POST"){
 $newbudget = $_POST['newBudget'];
 $teamid = $_POST['teamID'];
 $teamClass -> updatebudget($newbudget,$teamid);
         header("Location:..//Dashboards/admindashboard.php");
}
else {
$teamid = $_GET['id'];
$allTeams = $teamClass -> affichage() ;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Team Budget</title>
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
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: #1e293b;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 600px;
            padding: 40px;
            border: 1px solid #334155;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: #ec4899;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #94a3b8;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            color: #e2e8f0;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input,
        select {
            width: 100%;
            padding: 12px 14px;
            background: #0f172a;
            border: 1px solid #334155;
            border-radius: 8px;
            color: #e2e8f0;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #ec4899;
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
            background: #1e293b;
        }

        input::placeholder {
            color: #64748b;
        }

        .error-message {
            display: none;
            color: #ef4444;
            font-size: 12px;
            margin-top: 6px;
        }

        .error-message.show {
            display: block;
        }

        .form-group.error input,
        .form-group.error select {
            border-color: #ef4444;
            background: rgba(239, 68, 68, 0.05);
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 32px;
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
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(236, 72, 153, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-cancel {
            background: #334155;
            color: #e2e8f0;
        }

        .btn-cancel:hover {
            background: #475569;
        }

        .success-message {
            display: none;
            background: rgba(236, 72, 153, 0.1);
            border: 1px solid #ec4899;
            color: #ec4899;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .success-message.show {
            display: block;
        }

        .form-title {
            color: #ec4899;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #334155;
        }

        .budget-info {
            background: rgba(236, 72, 153, 0.05);
            border: 1px solid #ec4899;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }

        .budget-info p {
            color: #cbd5e1;
            font-size: 14px;
            margin: 8px 0;
        }

        .budget-info strong {
            color: #ec4899;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>💰 Update Team Budget</h1>
            <p>Modify the budget for an existing team</p>
        </div>

        <div class="success-message" id="successMessage">
            Team budget updated successfully!
        </div>

        <form id="budgetForm" action="budgetedit.php" method="POST">
            <div class="form-title">Select Team</div>

            <div class="form-group">
                <label for="team">Team Name *</label>
                <p class="form-title" style="font-size: 2rem;"><?php foreach ($allTeams as $key) {
                    if($key['id']==$teamid){
                        echo $key['name'];
                    }
                }
                ?></p>
            </div>

            <div class="budget-info" id="budgetInfo" style="display: none;">
                <p>Current Budget: <strong id="currentBudget">-</strong></p>
                <p>Last Updated: <strong id="lastUpdated">-</strong></p>
            </div>

            <div class="form-title">Update Budget</div>

            <div class="form-group">
                <label for="newBudget">New Budget (in millions) *</label>
                <input type="number" id="newBudget" name="newBudget"
                 placeholder="Enter new budget amount" value="<?php foreach ($allTeams as $key) {
                    if($key['id']==$teamid){
                        echo $key['budget'];
                    }
                }
                ?>" min="0" step="0.01" required>
                <input name='teamID' value='<?=$teamid?>' type='hidden'>
                <div class="error-message">Budget must be a valid positive number</div>
            </div>

            <div class="form-group">
                <label for="reason">Reason for Change</label>
                <input type="text" id="reason" name="reason" placeholder="Optional: explain the budget change">
            </div>

            <div class="button-group">
                <button type="submit" class="btn-submit">Update Budget</button>
                <button type="reset" class="btn-cancel">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('budgetForm');
        const successMessage = document.getElementById('successMessage');
        const teamSelect = document.getElementById('team');
        const budgetInfo = document.getElementById('budgetInfo');

        // Mock data for current budgets
        const teamBudgets = {
            1: { name: 'Manchester United', budget: 550, updated: '2025-12-15' },
            2: { name: 'Liverpool FC', budget: 520, updated: '2025-12-20' },
            3: { name: 'Chelsea FC', budget: 580, updated: '2025-12-10' },
            4: { name: 'Arsenal FC', budget: 480, updated: '2025-12-18' },
            5: { name: 'Real Madrid', budget: 620, updated: '2025-12-12' }
        };

        // Show current budget when team is selected
        teamSelect.addEventListener('change', function () {
            if (this.value && teamBudgets[this.value]) {
                const teamData = teamBudgets[this.value];
                document.getElementById('currentBudget').textContent = `$${teamData.budget}M`;
                document.getElementById('lastUpdated').textContent = teamData.updated;
                budgetInfo.style.display = 'block';
            } else {
                budgetInfo.style.display = 'none';
            }
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Reset error states
            document.querySelectorAll('.form-group').forEach(group => {
                group.classList.remove('error');
            });

            let isValid = true;

            const team = document.getElementById('team').value;
            if (!team) {
                showError('team', 'Please select a team');
                isValid = false;
            }

            const newBudget = document.getElementById('newBudget').value.trim();
            if (!newBudget || isNaN(newBudget) || parseFloat(newBudget) < 0) {
                showError('newBudget', 'Budget must be a valid positive number');
                isValid = false;
            }

            if (isValid) {
                const formData = {
                    teamId: team,
                    teamName: teamSelect.options[teamSelect.selectedIndex].text,
                    newBudget: parseFloat(newBudget),
                    reason: document.getElementById('reason').value.trim() || 'No reason provided'
                };

                console.log('Budget Update Data:', formData);

                successMessage.classList.add('show');
                form.reset();
                budgetInfo.style.display = 'none';

                setTimeout(() => {
                    successMessage.classList.remove('show');
                }, 3000);
            }
        });

        function showError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const group = field.parentElement;
            const errorMsg = group.querySelector('.error-message');

            group.classList.add('error');
            if (errorMsg) {
                errorMsg.textContent = message;
                errorMsg.classList.add('show');
            }
        }
    </script>
</body>
</html>
