<?php
session_start();
if($_SESSION['user']!="visitor"){
    header("location:logout.php");
}
else{
    require_once "HeaderByUserType/visitorHeader.php";
}
?>
    <div class="container">
        <div class="tabs">
            <button class="tab-btn active" onclick="switchTab('market')">Market Consultation</button>
            <button class="tab-btn" onclick="switchTab('history')">Public Transfer History</button>
            <button class="tab-btn" onclick="switchTab('profiles')">Player Profiles</button>
        </div>

        <!-- Market Consultation Tab -->
        <div id="market" class="tab-content active">
            <div class="search-bar">
                <input type="text" class="search-input" id="marketSearch" placeholder="Search players or teams...">
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Players</div>
                    <div class="stat-value">156</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Active Teams</div>
                    <div class="stat-value">12</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Market Value</div>
                    <div class="stat-value">$2.4B</div>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Player</th>
                            <th>Position</th>
                            <th>Current Team</th>
                            <th>Nationality</th>
                            <th>Age</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="marketTable">
                        <tr>
                            <td class="player-name">Mohamed Salah</td>
                            <td>Forward</td>
                            <td><span class="team-badge">Liverpool</span></td>
                            <td>Egypt</td>
                            <td>32</td>
                            <td><button class="action-btn" onclick="viewProfile('Mohamed Salah', 'Forward', 'Egypt')">View</button></td>
                        </tr>
                        <tr>
                            <td class="player-name">Kevin De Bruyne</td>
                            <td>Midfielder</td>
                            <td><span class="team-badge">Manchester City</span></td>
                            <td>Belgium</td>
                            <td>33</td>
                            <td><button class="action-btn" onclick="viewProfile('Kevin De Bruyne', 'Midfielder', 'Belgium')">View</button></td>
                        </tr>
                        <tr>
                            <td class="player-name">Vinicius Jr</td>
                            <td>Forward</td>
                            <td><span class="team-badge">Real Madrid</span></td>
                            <td>Brazil</td>
                            <td>24</td>
                            <td><button class="action-btn" onclick="viewProfile('Vinicius Jr', 'Forward', 'Brazil')">View</button></td>
                        </tr>
                        <tr>
                            <td class="player-name">Rodri</td>
                            <td>Midfielder</td>
                            <td><span class="team-badge">Manchester City</span></td>
                            <td>Spain</td>
                            <td>28</td>
                            <td><button class="action-btn" onclick="viewProfile('Rodri', 'Midfielder', 'Spain')">View</button></td>
                        </tr>
                        <tr>
                            <td class="player-name">Jude Bellingham</td>
                            <td>Midfielder</td>
                            <td><span class="team-badge">Real Madrid</span></td>
                            <td>England</td>
                            <td>21</td>
                            <td><button class="action-btn" onclick="viewProfile('Jude Bellingham', 'Midfielder', 'England')">View</button></td>
                        </tr>
                        <tr>
                            <td class="player-name">Erling Haaland</td>
                            <td>Forward</td>
                            <td><span class="team-badge">Manchester City</span></td>
                            <td>Norway</td>
                            <td>24</td>
                            <td><button class="action-btn" onclick="viewProfile('Erling Haaland', 'Forward', 'Norway')">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <button class="active">1</button>
                <button>2</button>
                <button>3</button>
                <button>Next</button>
            </div>
        </div>

        <!-- Public Transfer History Tab -->
        <div id="history" class="tab-content">
            <div class="search-bar">
                <input type="text" class="search-input" id="historySearch" placeholder="Search transfers...">
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Transfers</div>
                    <div class="stat-value">47</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Value</div>
                    <div class="stat-value">$893M</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">This Month</div>
                    <div class="stat-value">8</div>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Player</th>
                            <th>From Team</th>
                            <th>To Team</th>
                            <th>Transfer Fee</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="historyTable">
                        <tr>
                            <td class="player-name">Jude Bellingham</td>
                            <td><span class="team-badge">Borussia Dortmund</span></td>
                            <td><span class="team-badge">Real Madrid</span></td>
                            <td>$113M</td>
                            <td>2023-07-03</td>
                        </tr>
                        <tr>
                            <td class="player-name">Cristiano Ronaldo</td>
                            <td><span class="team-badge">Manchester United</span></td>
                            <td><span class="team-badge">Al Nassr</span></td>
                            <td>$75M</td>
                            <td>2023-01-01</td>
                        </tr>
                        <tr>
                            <td class="player-name">Harry Kane</td>
                            <td><span class="team-badge">Tottenham</span></td>
                            <td><span class="team-badge">Bayern Munich</span></td>
                            <td>$100M</td>
                            <td>2023-08-31</td>
                        </tr>
                        <tr>
                            <td class="player-name">Declan Rice</td>
                            <td><span class="team-badge">West Ham</span></td>
                            <td><span class="team-badge">Arsenal</span></td>
                            <td>$105M</td>
                            <td>2023-07-27</td>
                        </tr>
                        <tr>
                            <td class="player-name">Alexis Mac Allister</td>
                            <td><span class="team-badge">Brighton</span></td>
                            <td><span class="team-badge">Liverpool</span></td>
                            <td>$35M</td>
                            <td>2023-06-29</td>
                        </tr>
                        <tr>
                            <td class="player-name">Moisés Caicedo</td>
                            <td><span class="team-badge">Brighton</span></td>
                            <td><span class="team-badge">Chelsea</span></td>
                            <td>$115M</td>
                            <td>2023-01-30</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <button class="active">1</button>
                <button>2</button>
                <button>3</button>
                <button>Next</button>
            </div>
        </div>

        <!-- Player Profiles Tab -->
        <div id="profiles" class="tab-content">
            <div class="search-bar">
                <input type="text" class="search-input" id="profileSearch" placeholder="Search player profiles...">
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Player Name</th>
                            <th>Role</th>
                            <th>Nationality</th>
                            <th>Team</th>
                            <th>Profile</th>
                        </tr>
                    </thead>
                    <tbody id="profileTable">
                        <tr>
                            <td class="player-name">Mohamed Salah</td>
                            <td>Player</td>
                            <td>Egypt</td>
                            <td><span class="team-badge">Liverpool</span></td>
                            <td><button class="action-btn" onclick="viewProfile('Mohamed Salah', 'Player', 'Egypt')">View</button></td>
                        </tr>
                        <tr>
                            <td class="player-name">Carlo Ancelotti</td>
                            <td>Coach</td>
                            <td>Italy</td>
                            <td><span class="team-badge">Real Madrid</span></td>
                            <td><button class="action-btn" onclick="viewProfile('Carlo Ancelotti', 'Coach', 'Italy')">View</button></td>
                        </tr>
                        <tr>
                            <td class="player-name">Erling Haaland</td>
                            <td>Player</td>
                            <td>Norway</td>
                            <td><span class="team-badge">Manchester City</span></td>
                            <td><button class="action-btn" onclick="viewProfile('Erling Haaland', 'Player', 'Norway')">View</button></td>
                        </tr>
                        <tr>
                            <td class="player-name">Pep Guardiola</td>
                            <td>Coach</td>
                            <td>Spain</td>
                            <td><span class="team-badge">Manchester City</span></td>
                            <td><button class="action-btn" onclick="viewProfile('Pep Guardiola', 'Coach', 'Spain')">View</button></td>
                        </tr>
                        <tr>
                            <td class="player-name">Vinicius Jr</td>
                            <td>Player</td>
                            <td>Brazil</td>
                            <td><span class="team-badge">Real Madrid</span></td>
                            <td><button class="action-btn" onclick="viewProfile('Vinicius Jr', 'Player', 'Brazil')">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <button class="active">1</button>
                <button>2</button>
                <button>Next</button>
            </div>
        </div>
    </div>

    <!-- Profile Modal -->
    <div id="profileModal" class="profile-modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeProfile()">×</button>
            <h2 id="profileName" style="color: #06b6d4; margin-bottom: 1rem;"></h2>
            <div class="profile-info">
                <div class="info-row">
                    <span class="info-label">Role:</span>
                    <span class="info-value" id="profileRole"></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nationality:</span>
                    <span class="info-value" id="profileNationality"></span>
                </div>
                <div class="info-row" style="border-bottom: none;">
                    <span class="info-label">Status:</span>
                    <span class="info-value">Active</span>
                </div>
            </div>
            <p style="margin-top: 1.5rem; color: #94a3b8; font-size: 0.875rem;">
                💡 Financial details and contract information are only available to authenticated users.
            </p>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));

            // Remove active from all buttons
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => btn.classList.remove('active'));

            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
        }

        function viewProfile(name, role, nationality) {
            document.getElementById('profileName').textContent = name;
            document.getElementById('profileRole').textContent = role;
            document.getElementById('profileNationality').textContent = nationality;
            document.getElementById('profileModal').classList.add('active');
        }

        function closeProfile() {
            document.getElementById('profileModal').classList.remove('active');
        }

        // Search functionality
        document.getElementById('marketSearch').addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#marketTable tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        document.getElementById('historySearch').addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#historyTable tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        document.getElementById('profileSearch').addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#profileTable tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('profileModal');
            if (event.target == modal) {
                modal.classList.remove('active');
            }
        }
    </script>
</body>
</html>
