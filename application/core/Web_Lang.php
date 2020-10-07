<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Web_Lang extends CI_Lang
{
    /**************************************************
    configuration
     ***************************************************/
    public $languages = array();
    // special URIs (not localized)
    public $special = array(
        "admin",
    );
    // where to redirect if no language in URI
    public $default_uri = 'en';
    /**************************************************/
    public function __construct()
    {
        parent::__construct();
        global $CFG;
        global $URI;
        global $RTR;
        $this->languages = $this->get_from_db();
        $segment = $URI->segment(1);
        if (isset($this->languages[$segment])) // URI with language -> ok
        {
            $language = $this->languages[$segment];
            $CFG->set_item('language', $language);
        } else if ($this->is_special($segment)) // special URI -> no redirect
        {
            return;
        } else // URI without language -> redirect to default_uri
        {
            // set default language
            $CFG->set_item('language', $this->languages[$this->default_lang()]);
            // redirect
            header("Location: " . $CFG->site_url($this->localized($this->default_uri)), true, 302);
            exit;
        }
    }
    // get current language
    // ex: return 'en' if language in CI config is 'english'
    public function lang()
    {
        global $CFG;
        $language = $CFG->item('language');
        $lang = array_search($language, $this->languages);
        if ($lang) {
            return $lang;
        }
        return null; // this should not happen
    }
    public function is_special($uri)
    {
        $exploded = explode('/', $uri);
        if (in_array($exploded[0], $this->special)) {
            return true;
        }
        if (isset($this->languages[$uri])) {
            return true;
        }
        return false;
    }
    public function switch_uri($lang)
    {
        $CI = &get_instance();
        $uri = $CI->uri->uri_string();
        if ($uri != "") {
            $exploded = explode('/', $uri);
            if ($exploded[0] == $this->lang()) {
                $exploded[0] = $lang;
            }
            $uri = implode('/', $exploded);
        }
        return $uri;
    }
    // is there a language segment in this $uri?
    public function has_language($uri)
    {
        $first_segment = null;
        $exploded = explode('/', $uri);
        if (isset($exploded[0])) {
            if ($exploded[0] != '') {
                $first_segment = $exploded[0];
            } else if (isset($exploded[1]) && $exploded[1] != '') {
                $first_segment = $exploded[1];
            }
        }
        if ($first_segment != null) {
            return isset($this->languages[$first_segment]);
        }
        return false;
    }
    // default language: first element of $this->languages
    public function default_lang()
    {
        foreach ($this->languages as $lang => $language) {
            return $lang;
        }
    }
    // add language segment to $uri (if appropriate)
    public function localized($uri)
    {
        if ($this->has_language($uri)
            || $this->is_special($uri)
            || preg_match('/(.+)\.[a-zA-Z0-9]{2,4}$/', $uri)) {
            // we don't need a language segment because:
            // - there's already one or
            // - it's a special uri (set in $special) or
            // - that's a link to a file
        } else {
            $uri = $this->lang() . '/' . $uri;
        }
        return $uri;
    }
    public function get_from_db()
    {
        require_once BASEPATH . 'database/DB' . EXT;
        $db = &DB();
        $db->select('*');
        $db->from('languages');
        $db->where('status', 'Y');
        $query = $db->get()->result();
        foreach ($query as $row) {
            $return[$row->code] = strtolower($row->name);
        }
        return $return;
    }
}
/* End of file */
