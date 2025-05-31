<?php
session_start();
include "connection.php";
session_unset();
session_destroy();
?>
<script>
// Clear all chat-related local storage
localStorage.removeItem('chatHistory');
localStorage.removeItem('chatSize');

// Redirect to homepage
window.location.href = 'index.php';
</script>