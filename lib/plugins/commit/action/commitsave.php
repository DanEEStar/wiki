<?php
/**
 * DokuWiki Plugin commit (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Daniel Egger <daniel.egger@gmail.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'action.php';

class action_plugin_commit_commitsave extends DokuWiki_Action_Plugin {

    public function register(Doku_Event_Handler &$controller) {
       $controller->register_hook('DOKUWIKI_DONE', 'AFTER', $this, 'handle_io_wikipage_write');
    }

    public function handle_io_wikipage_write(Doku_Event &$event, $param) {
        //error_reporting(-1);
        require_once '/srv/http/wiki.danielegger.ch/lib/plugins/commit/git/Git.php';
        $repo = Git::open('/srv/http/wiki.danielegger.ch');
        $repo->add('*');
        $repo->commit('wiki change: added changed files');
    }

}

// vim:ts=4:sw=4:et:
