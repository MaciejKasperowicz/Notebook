<div>
    <h3>Nowa notatka</h3>
    <div>
        <?php if($params["created"]) : ?>
        <div>
            <h4>Tytuł: <?php echo $params["title"]?></h4>
            <h4>Treść: <?php echo $params["description"]?></h4>
        </div>
        <?php else: ?>
        <form action="/?action=create" method="POST">
            <ul>
                <li>
                    <label for="">Tytuł<span?>*</span></label>
                    <input type="text" name="title"/>
                </li>
                <li>
                    <label for="">Treść</label>
                    <textarea name="description"></textarea>
                </li>
                <li>
                    <input type="submit" value="Submit">
                </li>
            </ul>
        </form>
        <?php endif; ?>
    </div>
</div>