<?php

echo '<header class="header">';
    echo'<div class="title">Daily-Do</div>';
    echo'<div class="desc">Manage your daily tasks</div>';
echo'</header>';

echo'<nav role="navigation">';
  echo'<div id="menuToggle">';
    // <!--
    // An input that acts like a checkbox to receive input-->
    echo'<input type="checkbox" />';
    // <!--horizontal lines-->
    echo'<span></span><span></span><span></span>';
    echo'<ul id="menu">';
    echo'<div class="menu-container">';
    echo'<a href="payments.php"><li>Home</li></a>';
    echo'<ul class="right">';
    echo'<a href="payments.php"><li>Payments</li></a>';
    echo'<a href="groceries.php"><li>Shopping/Groceries</li></a>';
    echo'<a href="fitness.php"><li>Fitness</li></a>';
    echo'<a href="chores.php"><li>Chores</li></a>';
    echo'</ul>';
    echo'<a href="profile.php"><li>View Profile</li></a>';
    echo'<a href="payments.php?logout=\'1\'"><li>Log Out</li></a>';
    echo'</div>';
    echo'</ul></div></nav>';

?>