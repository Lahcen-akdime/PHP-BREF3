<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team</title>
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
            color: #10b981;
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
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
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
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-reset {
            background: #334155;
            color: #e2e8f0;
        }

        .btn-reset:hover {
            background: #475569;
        }

        .success-message {
            display: none;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .success-message.show {
            display: block;
        }

        .form-title {
            color: #10b981;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #334155;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⚽ Add Team</h1>
            <p>Create a new team in the system</p>
        </div>

        <div class="success-message" id="successMessage">
            Team added successfully!
        </div>

        <form id="teamForm">
            <div class="form-title">Basic Information</div>

            <div class="form-group">
                <label for="name">Team Name *</label>
                <input type="text" id="name" name="name" placeholder="Enter team name" required>
                <div class="error-message">Team name is required</div>
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" placeholder="Enter team email" required>
                <div class="error-message">Please enter a valid email</div>
            </div>

            <div class="form-group">
                <label for="city">City *</label>
                <input type="text" id="city" name="city" placeholder="Enter team city" required>
                <div class="error-message">City is required</div>
            </div>

            <div class="form-title">Team Details</div>

            <div class="form-group">
                <label for="budget">Budget *</label>
                <input type="number" id="budget" name="budget" placeholder="Enter team budget" required>
                <div class="error-message">Budget is required and must be a number</div>
            </div>

            <div class="form-group">
                <label for="manager">Manager Name *</label>
                <input type="text" id="manager" name="manager" placeholder="Enter manager name" required>
                <div class="error-message">Manager name is required</div>
            </div>

            <div class="form-group">
                <label for="founded">Year Founded *</label>
                <input type="number" id="founded" name="founded" placeholder="Enter year founded" min="1900" max="2099" required>
                <div class="error-message">Year founded is required</div>
            </div>

            <div class="button-group">
                <button type="submit" class="btn-submit">Add Team</button>
                <button type="reset" class="btn-reset">Clear</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('teamForm');
        const successMessage = document.getElementById('successMessage');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Reset error states
            document.querySelectorAll('.form-group').forEach(group => {
                group.classList.remove('error');
            });

            // Validate fields
            let isValid = true;

            const name = document.getElementById('name').value.trim();
            if (!name) {
                showError('name', 'Team name is required');
                isValid = false;
            }

            const email = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email || !emailRegex.test(email)) {
                showError('email', 'Please enter a valid email');
                isValid = false;
            }

            const city = document.getElementById('city').value.trim();
            if (!city) {
                showError('city', 'City is required');
                isValid = false;
            }

            const budget = document.getElementById('budget').value.trim();
            if (!budget || isNaN(budget) || parseInt(budget) <= 0) {
                showError('budget', 'Budget must be a valid positive number');
                isValid = false;
            }

            const manager = document.getElementById('manager').value.trim();
            if (!manager) {
                showError('manager', 'Manager name is required');
                isValid = false;
            }

            const founded = document.getElementById('founded').value.trim();
            if (!founded || isNaN(founded)) {
                showError('founded', 'Year founded is required');
                isValid = false;
            }

            if (isValid) {
                // Prepare data for submission
                const formData = {
                    name: name,
                    email: email,
                    city: city,
                    budget: parseInt(budget),
                    manager: manager,
                    founded: parseInt(founded)
                };

                console.log('Team Data Ready to Submit:', formData);
                
                // Show success message
                successMessage.classList.add('show');
                form.reset();

                // Hide success message after 3 seconds
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
