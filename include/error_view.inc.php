<?php
function displayErrors($errors) {
    if (!empty($errors)) {
        echo '<div class="error-message">';
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
        echo '</div>';
    }
}
