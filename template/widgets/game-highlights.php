<div style="display:flex; gap:15px;flex-direction:column">
    <?php foreach ($topGames as $topGame): ?>
        <div
            style="background-color: #f8f9fa; padding: 20px; width: auto; font-family: Arial, sans-serif; border: 1px solid #dee2e6; border-radius: 8px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="margin: 0; color: #343a40;"><?= $topGame['game_title'] ?></h3>
                    <p style="margin: 5px 0 0 0; color: #6c757d;"><?= $topGame['venue'] ?></p>
                    <p style="margin: 5px 0 0 0; color: #6c757d;"><?= $topGame['athlete'] ?></p>
                </div>
                <div style="text-align: right;">
                    <h2 style="margin: 0; color: rgb(54, 162, 235);"><?= $topGame['avg_overall_rating'] ?></h2>
                    <p style="margin: 5px 0 0 0; color: #6c757d;"><?= Sport::getDescription($topGame['sport']) ?></p>
                    <p style="margin: 5px 0 0 0; color: #6c757d;"><?= $topGame['schedule'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>