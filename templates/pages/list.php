<div class="list">
    <section>
        <div class="message">
            <?php if(!empty($params["error"])){
                switch ($params["error"]) {
                    case "missingNoteId":
                        ?>
                        <h3 style="color: red">Niepoprawny identyfikator notatki</h3>
                        <?php
                        break;
                    case "noteNotFound":
                        ?>
                        <h3 style="color: red">Notatka nie została znaleziona</h3>
                        <?php
                        break;
                }
            }
            ?>  
        </div>
        <div class="message">
            <?php if(!empty($params["before"])){
                switch ($params["before"]) {
                    case "created":
                        ?>
                        <h3 style="color: green">Notatka została utworzona</h3>
                        <?php
                        break;
                    case "edited":
                        ?>
                        <h3 style="color: blue">Notatka została edytowana</h3>
                        <?php
                        break;
                    case "deleted":
                        ?>
                        <h3 style="color: violet">Notatka
                        została usunięta</h3>
                        <?php
                        break;
                }
            }
            ?>  
        </div>

        <?php
            $sort = $params["sort"] ?? [];
            $by = $sort["by"] ?? "title";
            $order = $sort["order"] ?? "desc";
        ?>

        <div>
            <form action="" class="settings-form" action="/" method="GET">
                <div>
                    <h4>Sortuj po:</h4>
                    <label>Tytule:<input name="sortby" type="radio" value="title"
                    <?php echo $by === "title" ? "checked" : "" ?>
                    ></label>
                    <label>Dacie:<input name="sortby" type="radio" value="created"
                    <?php echo $by === "created" ? "checked" : "" ?>
                    ></label>
                </div>
                <div>
                    <h4>Kierunek sortowania:</h4>
                    <label>Rosnąco:<input name="sortorder" type="radio" value="asc"
                    <?php echo $order === "asc" ? "checked" : "" ?>
                    ></label>
                    <label>Malejąco:<input name="sortorder" type="radio" value="desc"
                    <?php echo $order === "desc" ? "checked" : "" ?>
                    ></label>
                </div>
                <input type="submit" value="Wyślij">
            </form>
        </div>
        
        <h3>Lista notatek</h3>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tytuł</th>
                        <th>Utworzona</th>
                        <th>Opcje</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    <?php foreach($params["notes"] ?? [] as $note): ?>
                        <tr>
                            <td><?php echo $note["id"] ?></td>
                            <td><?php echo $note["title"] ?></td>
                            <td><?php echo $note["created"] ?></td>
                            <td>
                                <a href="/?action=show&id=<?php echo (int) $note["id"]?>">
                                    <button>Szczegóły</button>
                                </a>
                                <a href="/?action=delete&id=<?php echo (int) $note["id"]?>">
                                    <button>Usuń</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
    