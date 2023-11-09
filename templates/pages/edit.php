<div>
    <h3>Edycja notatki</h3>
    <div>
        <?php if(!empty($params['note'])): ?>
        <?php 
            $note= $params["note"];
        ?>
        <form action="/?action=edit" method="POST">
        <input name="id" type="hidden" value="<?php echo $note['id'] ?>"/>
            <ul>
                <li>
                    <label for="">Tytuł<span?>*</span></label>
                    <input type="text" name="title"
                        value="<?php echo $note['title'] ?>"
                    />
                </li>
                <li>
                    <label for="">Treść</label>
                    <textarea name="description"><?php echo $note['description'] ?>
                    </textarea>
                </li>
                <li>
                    <input type="submit" value="Submit">
                </li>
            </ul>
        </form>
        <?php else: ?>
            <div>
                Brak danych do wyświetlenia
                <a href="/"><button>Powrót do listy notatek</button></a>
            </div>
        <?php endif; ?>
    </div>
</div>