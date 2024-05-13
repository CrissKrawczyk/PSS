<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('welcomeScreen');
App::getRouter()->setLoginRoute('login');

Utils::addRoute('welcomeScreen', 'WelcomeScreenCtrl', ['user']);
Utils::addRoute('userPage', 'UserCtrl', ['user']);
Utils::addRoute('adminPage', 'AdminCtrl', ['admin']);
Utils::addRoute('createUser',        'SignUpCtrl', ['admin']);
Utils::addRoute('signUp',        'SignUpCtrl');
Utils::addRoute('login',         'LoginCtrl');
Utils::addRoute('logout',        'LoginCtrl');

Utils::addRoute('generateTestCode',     'CodeGeneratorCtrl', ['admin']);
Utils::addRoute('showCodeGenerator',     'CodeGeneratorCtrl', ['user']);
Utils::addRoute('buyCode',     'CodeGeneratorCtrl', ['user']);
Utils::addRoute('useCode',     'UseCodeCtrl', ['user']);

Utils::addRoute('deleteUser',     'AdminCtrl', ['admin']);

Utils::addRoute('addUserCard',     'AddUserCardCtrl', ['user']);
Utils::addRoute('addCard',     'AddCardCtrl', ['user']);
Utils::addRoute('createDeck',     'CreateDeckCtrl', ['user']);
Utils::addRoute('addToDeckList',     'AddToDeckCtrl', ['user']);
Utils::addRoute('addToDeck',     'AddToDeckCtrl', ['user']);
Utils::addRoute('deckPage',     'DeckCtrl', ['user']);
Utils::addRoute('deleteDeck',     'DeckCtrl', ['user']);
Utils::addRoute('removeDeckFromFav',     'DeckCtrl', ['user']);
Utils::addRoute('addDeckToFav',     'DeckCtrl', ['user']);
