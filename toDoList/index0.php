<?php 
require 'connexion.php';
require 'html/header.php';

?>
       <?php 
            $sql1 = "SELECT * FROM todo ORDER BY id DESC";

            $todos1 = $conn->prepare($sql1);
            $todos1->execute();
            $show=$todos1->fetchAll(PDO::FETCH_ASSOC);
       ?>

        
<!-- debut main section -->
    <div class="main-section">

        <!-- section ajouter -->
       <div class="add-section">

            <!-- formulaire -->
            <form action="app/ajouter.php" method="POST" autocomplete="off">

                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'): ?>
                    
                    <input type="text" 
                        name="title" 
                        style="border-color: #ff6666"
                        placeholder="Completez le champ s'il vous plait :)" 
                    />

                    <textarea name="description" id="description" cols="30" rows="4" 
                              placeholder="Decrivez votre tache"
                              style="border-color: #ff6666"
                              ></textarea>

                    <button type="submit">
                        Add &nbsp; <span>&#43;</span>
                    </button>

                <?php else: ?>

                    <input type="text" 
                        name="title" 
                        placeholder="Qu'est-ce que vous voulez faire?" 
                    />

                    <textarea name="description" id="description" cols="30" rows="4"
                        placeholder="Decrivez votre tache"></textarea>
                    
                    <button type="submit">
                        Ajouter &nbsp; <span>&#43;</span>
                    </button>
                <?php endif; ?>
            </form>
            <!-- Fin Formulaire -->
       </div>
       <!-- Fin section Ajouter -->
       <?php 
            $sql = "SELECT * FROM todo ORDER BY id DESC";
            $todos = $conn->prepare($sql);
            $todos->execute();
            
       ?>

        <!-- section affichage -->
       <div class="show-todo-section">

        <!-- recherche -->
            
            <?php if(@$resultat):?>

                <?php echo "<h2>"."Voici le resultat de votre recherche"."</h2>";?>

                <?php foreach($resultat as $task): ?>

                    <div class="todo-item">

                        <ul>
                            <li>
                                <a href="app/supprimer.php?id=<?=$task['id']?>">
                                <img src="img/trash.png" alt="trash"></a>
                            </li>
                            <li>
                                <a href="app/modifier.php?id=<?=$task['id']?>">
                                <img src="img/pen.png" alt="pen" ></a>
                            </li>
                        </ul>

                        <?php if(@$task['checked']): ?> 
                            <a href="checkboxchecked.php?id=<?php echo $task['id']; ?>">
                                <div id="blabla"></div>
                                <input type="checkbox" 
                                class="check-box " 
                                id ="<?php echo $task['id']; ?>"
                                checked /></a>

                            <h2 class="checked"><?php echo $task['title'] ?></h2>

                            <h3><?php echo $task['description'] ?></h3>

                        <?php else: ?>

                            <a href="checkboxunchecked.php?id=<?php echo $task['id']; ?>">
                                <div id="blabla"></div>
                                <input type="checkbox"
                                id ="<?php echo $task['id']; ?>"
                                class="check-box"
                                /> 
                            </a>

                            <h2><?php echo $task['title']?></h2>

                            <h3><?php echo $task['description'] ?></h3>
                    
                        <?php endif; ?>
                    
                        <br>

                        <div>
                            <small>cree le: <?php echo $task['date_time'] ?></small> 
                        </div>
                    </div>
                <?php endforeach;?>
        <!-- fin recherche -->           
            <?php else:?>
        
                <?php if($todos->rowCount() <= 0): ?>

                        <div class="todo-item">
                            <div class="empty">
                                <img src="img/f.png" width="50%" />
                                <br>
                                <img src="img/Ellipsis.gif" width="30px">
                            </div>
                        </div>
                        
                <?php endif; ?>

                <?php $todo = $todos->fetchall(PDO::FETCH_ASSOC); ?>
     
                <?php foreach($todo as $tache): ?>

                    <div class="todo-item">

                        <ul>
                            <li><a href="app/supprimer.php?id=<?=$tache['id']?>">
                                <img src="img/trash.png" alt="trash"></a>
                            </li>
                            <li><a href="app/modifier.php?id=<?=$tache['id']?>">
                                <img src="img/pen.png" alt="pen" ></a>
                            </li>
                        </ul>
                        
    
                        <?php if(@$tache['checked']): ?> 
                                    
                            <a href="checkboxchecked.php?id=<?php echo $tache['id']; ?>">
                                <div id="blabla"></div>
                                <input type="checkbox"
                                class="check-box "
                                id ="<?php echo $tache['id']; ?>"
                                checked/>
                            </a>
            
                            <h2 class="checked"><?php echo $tache['title'] ?></h2>

                            <h3><?php echo $tache['description'] ?></h3>

                        <?php else: ?>

                            <a href="checkboxunchecked.php?id=<?php echo $tache['id']; ?>">
                                <div id="blabla"></div>
                                <input type="checkbox"
                                id ="<?php echo $tache['id']; ?>"
                                class="check-box"
                                /> 
                            </a>

                            <h2><?php echo $tache['title']?></h2>
                            <h3><?php echo $tache['description'] ?></h3>
                            
                        <?php endif; ?>
                        <br>

                        <div>
                            <small>cree le: <?php echo $tache['date_time'] ?></small> 
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php $todos->closeCursor(); ?>
                </div>

                <!-- Fin Affiche to do list -->


                    <?php 
                        $sql1 = "SELECT * FROM todo ORDER BY id DESC";

                        $todos1 = $conn->prepare($sql1);
                        $todos1->execute();
                        $show=$todos1->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                
                </div>
            <?php endif;?>
    
    <?php
       require 'html/footer.php';
    ?>