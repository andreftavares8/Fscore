<?php

/* Descrição: Configurações da aplicação
 * Autor: Mário Pinto
 * 
 */
define('DESC', 'Página principal');
define('DEBUG', true);
define('UC', 'PAW');
define('AUTHOR', 'Mário Pinto');


$db_web = [
    'host' => 'mysql-sa.mgmt.ua.pt',
    'port' => '3306',
    'dbname' => 'esan-dsg01',
    'username' => 'esan-dsg01-web',
    'password' => 'uka5noX042ZC8TBU',
    'charset' => 'utf8'
];
$db_dbo = [
    'host' => 'mysql-sa.mgmt.ua.pt',
    'port' => '3306',
    'dbname' => 'esan-dsg01',
    'username' => 'esan-dsg01-dbo',
    'password' => 'wfrt2Mw8uAEsQKYQ',
    'charset' => 'utf8'
];


function connectDB($db) {
    try {
        $sqldb = new PDO(
                'mysql:host=' . $db['host'] . '; ' .
                'dbname=' . $db['dbname'] . ';' .
                'port=' . $db['port'] . ';' .
                'charset=' . $db['charset'] . ';',
                $db['username'], $db['password']);
    } catch (PDOException $e) {
        die('Erro ao ligar ao servidor ' . $e->getMessage());
    }
    return $sqldb;
}

/**
 * Array que contém os módulos da aplicação 
 */
$modules = Array(
    'fscore' => Array('enabled' => true, 'text' => 'Fscore', 'link' => '?m=encontros&a=encontros-do-dia'),
    'competicoes' => Array('enabled' => true, 'text' => 'Competicões', 'link' => '?m=competicoes&a=competicao'),
    'favoritos' => Array('enabled' => true, 'text' => 'Favoritos', 'link' => '?m=favoritos&a=favoritos'),
    'encontros' => Array('disable' => true, 'text'=> 'encontro', 'link' =>'?'),
    'equipas' => Array('disable' => true, 'text' => 'equipas', 'link' => '?m=equipas&a=equipa'),
    'perfil' => Array('disable' => true, 'text' => 'perfil', 'link' => '?m=perfil&a=utilizador'),
    'jogadores' => Array('disable' => true, 'text' => 'jogadores', 'link' => '?m=jogadores&a=jogador'),
    'treinadores' => Array('disable' => true, 'text' => 'treinadores', 'link' => '?m=treinadores&a=treinador'),
    'pesquisas' => Array('disable' => true, 'text' => 'pesquisas', 'link' => '?m=pesquisas&a=pesquisa')
);

/**
 * Função para carregar os items do menu
 * @param $module string com o módulo ativo
 * @param $modules array com os módulos
 * @return string String com HTML do menu
 */
function loadMenu($module = '',$modules = Array()) {
    $html = '';
    foreach ($modules as $m => $item) {
        if ($item['enabled']) {
            $html .= '<a id="txt_menu" class="nav-link ' . ( ($m == $module) ? 'active' : '' ) . '" href="' . $item['link'] . '">' . $item['text'] . '</a>';
        }
    }
    return $html;
}

/**
 * Função para validar um módulo
 * @param $module string com o módulo a validar
 * @param $modules array com os módulos
 * @return Boolean Devolve <b>TRUE</b> caso o módulo exista, <b>FALSE</b> caso contrário
 */
function validateModule($module, $modules) {
    $result = false;
    foreach ($modules as $m => $item) {
        $result = $result || $m == $module;
    }
    return $result;
}
