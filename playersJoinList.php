<?php
require_once "joinClass.php" ;
$id = $_GET['id'] ;
$allplayers = $joinClass -> allTeamPlayers($id) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players Gallery</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #e2e8f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
        }

        .header h1 {
            font-size: 3em;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            color: #94a3b8;
            font-size: 1.1em;
        }

        .players-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .player-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid #06b6d4;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(6, 182, 212, 0.1);
        }

        .player-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(6, 182, 212, 0.25);
            border-color: #0891b2;
        }

        .player-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 3em;
            font-weight: bold;
            color: white;
        }

        .player-name {
            font-size: 1.5em;
            font-weight: 700;
            margin-bottom: 10px;
            color: #f1f5f9;
        }

        .player-email {
            color: #06b6d4;
            font-size: 0.95em;
            margin-bottom: 8px;
            word-break: break-all;
        }

        .player-role {
            color: #cbd5e1;
            font-size: 0.9em;
            background: rgba(6, 182, 212, 0.1);
            padding: 6px 12px;
            border-radius: 20px;
            display: inline-block;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2em;
            }

            .players-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }

            .player-card {
                padding: 20px;
            }

            .player-icon {
                width: 100px;
                height: 100px;
                font-size: 2.5em;
            }

            .player-name {
                font-size: 1.2em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Players Gallery</h1>
            <p>View all registered players in the team</p>
        </div>
        <div class="players-grid">
            <?php 
            $number = 1;
            foreach ($allplayers as $key) {?>
                <div class="player-card">
                    <div class="player-icon"><?=$number++?></div>
                    <div class="player-name"><?= $key['name']?></div>
                    <div class="player-email"><?=$key['email']?></div>
                    <div class="player-role"><?=$key['role']?></div>
                </div>
            <?php }?>
        </div>
    </div>
</body>
</html>
