<?php

SESSION_START();

SESSION_UNSET($_SESSION);

unset($_SESSION['email']);

unset($_SESSION['token']);

SESSION_DESTROY();

header("Location: http://localhost/course_backend/");

?>