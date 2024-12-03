<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stats | <?= $athlete['full_name'] ?></title>
    <link rel="stylesheet" href="../vendor/fontawesome-6.5.1/css/all.min.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../vendor/chartjs/chart.js"></script>
    <script src="../assets/js/print.js"></script>
</head>

<body id="body" style="margin: 0; font-family: 'Arial', sans-serif; background-color: #e8e8e8; color: #f1f1f1;">
    <span style="float:right">
        <button onclick="print_div('body')"><i class="fa-solid fa-print"></i></button>
    </span>
    <!-- Main Profile Section -->
    <main style="padding: 40px;">
        <div style="display: flex; justify-content: space-between;">

            <!-- Left Column (Athlete Info) -->
            <div style="width: 30%; background-color: #fff; color:#242429; border-radius: 10px; padding: 20px;">
                <div class="athlete-photo"
                    style="background-color: #333; width: 100%; height: 350px; border-radius: 10px; margin-bottom: 20px; overflow: hidden;">
                    <img src="../assets/uploads/docs/<?= $athlete['user_id'] ?>/<?= $athlete['picture'] ?>" alt=""
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h2 style="font-size: 32px; margin-bottom: 10px;"><?= $athlete['full_name'] ?></h2>
                <!-- <p style="margin-bottom: 20px;">Marine Dursus is 30 years old (May 12, 1993), 172 cm tall and plays for
                    France. She is known for her exceptional skills and game sense on the court.</p> -->
                <div style="display: flex; flex-direction: column; gap: 10px;margin-top:30px">
                    <div><strong>Sport:</strong> <?= Sport::getDescription($athlete['sport']) ?></div>
                    <div><strong>Date of Birth:</strong> <?= Helper::formatDate($athlete['birthday'], 'd F Y') ?></div>
                    <div><strong>Adress:</strong> <?= $athlete['address'] ?></div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px;margin-top:30px; font-style:italic">
                    <?php if ($remark):?>
                    <p>
                        “<?= $remark ?>”<br>
                        <span style="font-size:0.9rem">- <?= $author ?></span>
                    </p>
                    <?php endif;?>
                </div>
            </div>

            <!-- Right Column (Statistics) -->
            <div style="width: 65%; display: flex; flex-direction: column; gap: 20px;">

                <!-- Ratings and Radar Chart Section (Aligned) -->
                <div
                    style="background-color: #fff; color:#242429; border-radius: 10px; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
                    <div style="width: 70%;">
                        <h3 style="font-size: 20px; margin-bottom: 20px;">Athlete Ratings</h3>
                        <div style="display: flex; justify-content: space-between;">

                            <!-- Teamwork Rating -->
                            <div style="width: 18%; text-align: center;">
                                <div style="font-size: 24px; color: #ff2c2c;"><?= $rating['teamwork'] ?></div>
                                <p style="margin: 5px 0;  color:#242429;">Teamwork</p>
                                <p style="font-size: 12px;">Collaborates effectively to achieve shared goals.</p>
                            </div>

                            <!-- Sportsmanship Rating -->
                            <div style="width: 18%; text-align: center;">
                                <div style="font-size: 24px; color: #ff2c2c;"><?= $rating['sportsmanship'] ?></div>
                                <p style="margin: 5px 0;  color:#242429;">Sportsmanship</p>
                                <p style="font-size: 12px;">Displays respect and fairness in the game.</p>
                            </div>

                            <!-- Technical Skills Rating -->
                            <div style="width: 18%; text-align: center;">
                                <div style="font-size: 24px; color: #ff2c2c;"><?= $rating['technical_skills'] ?></div>
                                <p style="margin: 5px 0;  color:#242429;">Tech Skills</p>
                                <p style="font-size: 12px;">Proficient in core mechanics of the game.</p>
                            </div>

                            <!-- Adaptability Rating -->
                            <div style="width: 18%; text-align: center;">
                                <div style="font-size: 24px; color: #ff2c2c;"><?= $rating['adaptability'] ?></div>
                                <p style="margin: 5px 0;  color:#242429;">Adaptability</p>
                                <p style="font-size: 12px;">Adjusts strategies in changing conditions.</p>
                            </div>

                            <!-- Game Sense Rating -->
                            <div style="width: 18%; text-align: center;">
                                <div style="font-size: 24px; color: #ff2c2c;"><?= $rating['game_sense'] ?></div>
                                <p style="margin: 5px 0;  color:#242429;">Game Sense</p>
                                <p style="font-size: 12px;">Deep understanding of strategy and positioning.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Radar Chart -->
                    <div style="width: 50%; display: flex; justify-content: center; align-items: center;">
                        <canvas id="radarChart" width="150" height="150"></canvas>
                    </div>
                </div>


                <!-- Statistics Table -->
                <div style="background-color: #fff; color:#242429; border-radius: 10px; padding: 20px;">
                    <h3 style="font-size: 20px; margin-bottom: 10px;">Previous Appearances</h3>
                    <table style="width: 100%; color:#242429; border-spacing: 0;">
                        <thead style="background-color: #a31a1a;color: #fff;">
                            <tr>
                                <th style="padding: 10px; text-align: left;">No.</th>
                                <th style="padding: 10px; text-align: left;">Day</th>
                                <th style="padding: 10px; text-align: left;">Date</th>
                                <th style="padding: 10px; text-align: left;">Venue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; ?>
                            <?php foreach ($gameEvents as $gameEvent): ?>
                                <tr style="border-bottom: 1px solid #333;">
                                    <td style="padding: 10px;"><?= str_pad($count, 2, '0', STR_PAD_LEFT) ?></td>
                                    <td style="padding: 10px;"><?= Helper::formatDate($gameEvent['schedule'], 'l') ?></td>
                                    <td style="padding: 10px;"><?= Helper::formatDate($gameEvent['schedule'], 'M d , Y') ?>
                                    </td>
                                    <td style="padding: 10px;"><?= $gameEvent['venue'] ?></td>
                                </tr>
                                <?php $count++; ?>
                            <?php endforeach; ?>
                            <?php if (count($gameEvents) < 1): ?>
                                <tr style="border-bottom: 1px solid #333;">
                                    <td colspan="4" style="text-align:center;padding-top:10px"> No Game available</td>
                                </tr>
                            <?php endif; ?>
                            <!-- Repeat similar rows as needed -->
                        </tbody>
                    </table>
                </div>

                <!-- Market Value and Stats Section -->
                <div style="display: flex; justify-content: space-between; gap: 20px;">
                    <!-- Best Event Highlight -->
                    <div
                        style="flex: 1 1 100%; background-color: #fff; color:#242429; border-radius: 10px; padding: 20px; box-sizing: border-box; min-width: 280px;">
                        <h3 style="font-size: 20px;">Best Event Played</h3>
                        <p style="font-size: 18px; color: #ff2c2c; margin-bottom: 5px;">
                            <?= $bestGame['game_title'] ?? 'N/A' ?>
                        </p>
                        <!-- Title -->
                        <p style=" color:#242429; margin-bottom: 5px;">Date:
                            <?= Helper::formatDate($bestGame['schedule'], 'D F j, Y') ?? 'N/A' ?>
                        </p> <!-- Date -->
                        <p style=" color:#242429; margin-bottom: 20px;">Venue: <?= $bestGame['venue'] ?? 'N/A' ?></p>
                        <!-- Venue -->

                        <!-- Ratings -->
                        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 10px;">
                            <div style="text-align: center; flex: 1 1 18%; min-width: 100px;">
                                <p style="font-size: 24px; color: #ff2c2c;"><?= $bestGame['teamwork'] ?? 0 ?></p>
                                <p style=" color:#242429;">Teamwork</p>
                            </div>
                            <div style="text-align: center; flex: 1 1 18%; min-width: 100px;">
                                <p style="font-size: 24px; color: #ff2c2c;"><?= $bestGame['sportsmanship'] ?? 0 ?></p>
                                <p style=" color:#242429;">Sportsmanship</p>
                            </div>
                            <div style="text-align: center; flex: 1 1 18%; min-width: 100px;">
                                <p style="font-size: 24px; color: #ff2c2c;"><?= $bestGame['technical_skills'] ?? 0 ?>
                                </p>
                                <p style=" color:#242429;">Tech Skills</p>
                            </div>
                            <div style="text-align: center; flex: 1 1 18%; min-width: 100px;">
                                <p style="font-size: 24px; color: #ff2c2c;"><?= $bestGame['adaptability'] ?? 0 ?></p>
                                <p style=" color:#242429;">Adaptability</p>
                            </div>
                            <div style="text-align: center; flex: 1 1 18%; min-width: 100px;">
                                <p style="font-size: 24px; color: #ff2c2c;"><?= $bestGame['game_sense'] ?? 0 ?></p>
                                <p style=" color:#242429;">Game Sense</p>
                            </div>
                        </div>
                    </div>

                    <div style="width: 50%; background-color: #fff; color:#242429; border-radius: 10px; padding: 20px;">
                        <h3 style="font-size: 20px;">Rank</h3>
                        <div style="display:flex;justify-content: center;align-items: center;">
                            <!-- <p style="font-size: 5rem; color: #ff2c2c;">#<?= $totalPlayed['total'] ?></p> -->
                            <p style="font-size: 5rem; color: #ff2c2c;">#<?= $ranking ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Chart.js Radar Chart Script -->
    <script>
        var ctx = document.getElementById('radarChart').getContext('2d');
        var radarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Teamwork', 'Sportsmanship', 'Technical Skills', 'Adaptability', 'Game Sense'],
                datasets: [{
                    label: 'Player Skills',
                    data: [
                        <?= $rating['teamwork'] ?>,
                        <?= $rating['sportsmanship'] ?>,
                        <?= $rating['technical_skills'] ?>,
                        <?= $rating['adaptability'] ?>,
                        <?= $rating['game_sense'] ?>
                    ],
                    backgroundColor: 'rgba(255, 31, 38, 0.2)',
                    borderColor: 'rgba(255, 31, 38, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    r: {
                        ticks: {
                            display: false,
                            stepSize: 2
                        },
                        grid: {
                            color: '#000'
                        },
                        angleLines: {
                            color: '#000'
                        },
                        pointLabels: {
                            color: '#000'
                        },
                        suggestedMin: 0,
                        suggestedMax: 10
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                }
            }
        });

    </script>
</body>

</html>