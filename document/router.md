
Routes et leur utilisation

/accueil: Cette route dirige l'utilisateur vers la page d'accueil de l'application via le HomepageController.

/services: Affiche une liste de tous les services disponibles, gérée par le HomepageController.

/deconnexion: Gère la déconnexion de l'utilisateur via le UserController.

/connexion: Dirige l'utilisateur vers la page de connexion, également via le UserController.

/créer-un-compte: Permet à l'utilisateur de s'inscrire sur la plateforme via le UserController.

/update_profile: Permet à l'utilisateur de mettre à jour son profil.

/view_message: Permet de visualiser un message spécifique en fonction de son ID via le MessageController.

/create_message: Gère la création de nouveaux messages via le MessageController.

/update_message et /edit_message: Ces routes permettent de mettre à jour ou de modifier un message existant.

/delete_message: Supprime un message en fonction de son ID.

/administrer: Gère la liste des utilisateurs pour les administrateurs via le AdminController.

/messages: Permet aux administrateurs de gérer tous les messages.

/edit_user et delete_user: Ces routes permettent aux administrateurs de modifier ou de supprimer des utilisateurs.

Routes liées aux événements (/event_index, /show_event, etc.): Gèrent divers aspects des événements, comme leur création, leur affichage, et leur suppression.

/getServices et /update_services: Ces routes sont utilisées pour récupérer et mettre à jour les services via le ServiceController.

/legal_notice: Affiche les mentions légales de l'application.

/faq: Affiche la FAQ pour aider les utilisateurs à mieux comprendre l'application.