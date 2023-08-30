<?php




abstract class AbstractController
{
    public function render(string $template, array $data = [])
    {
        // Extraire les variables du tableau de données afin qu'elles puissent être utilisées directement dans le template
        extract($data);

        // Inclure le fichier de layout principal
        require 'templates/layout.phtml';
    }

    protected function renderPartial(string $template, array $values)
    {
        // Extraire les valeurs du tableau afin qu'elles puissent être utilisées comme des variables dans le template
        extract($values);

        // Inclure le fichier de template correspondant
        require "templates/" . $template . ".phtml";
    }
}
