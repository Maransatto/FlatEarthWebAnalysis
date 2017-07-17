<?php
require_once('../lib/Phirehose.php');
require_once('../lib/OauthPhirehose.php');

/**
 * Aula 1 - Introdução a BigData
 * Fatec Shunji Nishimura
 * Prof. Allan Siriani
 */
class FilterTrackConsumer extends OauthPhirehose
{
  public function enqueueStatus($status)
  {

    $data = json_decode($status, true);
    if (is_array($data) && isset($data['user']['screen_name'])) {
      print $data['user']['screen_name'] . ': ' . urldecode($data['text']) . "\n";
    }
  }
}

// PEssoal aqui vocês coloquem as chaves para acessar a API
define("TWITTER_CONSUMER_KEY", "1Q0J37qBhPpfBYdHWl3t3cLOG");
define("TWITTER_CONSUMER_SECRET", "SPdGdRr506KqUfS0RJFVTN2OGYtCjRlV4O7j2RKbWMgLJC22Vo");

// Aqui são as chaves de acesso aos dados do Twitter
define("OAUTH_TOKEN", "2676680085-HrkW5z0muH7BcV7h3wDMPxM7ZgeNzrfd7ypFlHa");
define("OAUTH_SECRET", "Db2mEudugm2Xn2wjxsJ8gZFeIADkV1AwIZTqKZtoPTAoK");

// Aqui Inicia o Streaming de dados
$sc = new FilterTrackConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
//Parâmetros ou verbetes para monitoramento.
//$sc->setLang('pt');
$sc->setTrack(array('flatearth', 'Flat Earth', 'flatearther', 'the earth is flat', 'no curvature', 'is a globe', 'it\'s a globe', 'spinning ball', 'there is curvature', '100% flat', 'earth is not flat', 'globalist', 'globalists', 'universal lie', 'nasa lies', 'debunking nasa', 'debunking flat earth', 'debunking globe'));
$sc->consume();
