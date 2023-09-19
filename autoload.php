<?php

//Models

require_once 'models/Message.php';
require_once 'models/QuoteRequest.php';
require_once 'models/Role.php';
require_once 'models/Service.php';
require_once 'models/User.php';
require_once 'models/Vehicle.php';
require_once 'models/Event.php';

// Abstract
require_once 'controllers/AbstractController.php';
require_once 'managers/AbstractManager.php';


// Controllers

require_once 'controllers/UserController.php';
require_once 'controllers/MessageController.php';
require_once 'controllers/ServiceController.php';
require_once 'controllers/VehicleController.php';
require_once 'controllers/RoleController.php';
require_once 'controllers/QuoteRequestController.php';
require_once 'controllers/HomepageController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/EventController.php';


// Managers
require_once 'managers/UserManager.php';
require_once 'managers/MessageManager.php';
require_once 'managers/ServiceManager.php';
require_once 'managers/RoleManager.php';
require_once 'managers/VehicleManager.php';
require_once 'managers/QuoteRequestManager.php';
require_once 'managers/EventManager.php';



// Services
require_once 'Services/router.php';
