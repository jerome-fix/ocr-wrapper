<?php

namespace Jfx\Ocr;

class Tesseract extends BaseOcr
{
    const PAGE_SEG_MODE_NONE = null;
    const PAGE_SEG_MODE_OSD = 0;
    const PAGE_SEG_MODE_AUTOMATIC_OSD = 1;
    const PAGE_SEG_MODE_AUTOMATIC = 2;
    const PAGE_SEG_MODE_AUTOMATIC_OCR = 3;
    const PAGE_SEG_MODE_SINGLE_COLUMN = 4;
    const PAGE_SEG_MODE_SINGLE_BLOCK_VERTICAL = 5;
    const PAGE_SEG_MODE_SINGLE_BLOCK = 6;
    const PAGE_SEG_MODE_SINGLE_LINE = 7;
    const PAGE_SEG_MODE_SINGLE_WORD = 8;
    const PAGE_SEG_MODE_SINGLE_WORD_CIRCLE = 9;
    const PAGE_SEG_MODE_SINGLE_CHARACTER = 10;

    const LANGUAGE_AFR  = 'afr'; //(Afrikaans)
    const LANGUAGE_AMH = 'amh'; //  (Amharic)
    const LANGUAGE_ARA = 'ara'; //  (Arabic)
    const LANGUAGE_ASM = 'asm'; //  (Assamese)
    const LANGUAGE_AZE = 'aze'; //  (Azerbaijani)
    const LANGUAGE_AZE_CYRL = 'aze_cyrl'; // cyrl (Azerbaijani - Cyrilic)
    const LANGUAGE_BEL = 'bel'; // (Belarusian)
    const LANGUAGE_BEN = 'ben'; //  (Bengali)
    const LANGUAGE_BOD = 'bod'; //  (Tibetan)
    const LANGUAGE_BOS = 'bos'; //  (Bosnian)
    const LANGUAGE_BUL = 'bul'; //  (Bulgarian)
    const LANGUAGE_CAT = 'cat'; //  (Catalan;       Valencian)
    const LANGUAGE_CEB = 'ceb'; //  (Cebuano)
    const LANGUAGE_CES = 'ces'; //  (Czech)
    const LANGUAGE_CHI_SIM = 'chi_sim'; //  (Chinese - Simplified)
    const LANGUAGE_CHI_TRA = 'chi_tra'; // tra (Chinese - Traditional)
    const LANGUAGE_CHR = 'chr'; //  (Cherokee)
    const LANGUAGE_CYM = 'cym'; //  (Welsh)
    const LANGUAGE_DAN = 'dan'; //  (Danish)
    const LANGUAGE_DAN_FRAK = 'dan_frak'; //  (Danish - Fraktur)
    const LANGUAGE_DEU = 'deu'; // (German)
    const LANGUAGE_DEU_FARK = 'deu_frak'; //  (German -       Fraktur)
    const LANGUAGE_DZO = 'dzo'; // (Dzongkha)
    const LANGUAGE_ELL = 'ell'; //  (Greek, Modern (1453-))
    const LANGUAGE_ENG = 'eng'; //  (English)
    const LANGUAGE_ENM = 'enm'; //  (English, Middle (1100-1500))
    const LANGUAGE_EPO = 'epo'; //  (Esperanto)
    const LANGUAGE_EQU = 'equ'; //  (Math / equation detection module)
    const LANGUAGE_EST = 'est'; //  (Estonian)
    const LANGUAGE_EUS = 'eus'; //  (Basque)
    const LANGUAGE_FAS = 'fas'; //  (Persian)
    const LANGUAGE_FIN = 'fin'; // (Finnish)
    const LANGUAGE_FRA = 'fra'; // (French)
    const LANGUAGE_FRK = 'frk'; // (Frankish)
    const LANGUAGE_FRM = 'frm'; // (French, Middle (ca.1400-1600))
    const LANGUAGE_GLE = 'gle'; // (Irish)
    const LANGUAGE_GLG = 'glg'; // (Galician)
    const LANGUAGE_GRC = 'grc'; // (Greek, Ancient (to 1453))
    const LANGUAGE_GUJ = 'guj'; // (Gujarati)
    const LANGUAGE_HAT = 'hat'; // (Haitian; Haitian Creole)
    const LANGUAGE_HEB = 'heb'; // (Hebrew)
    const LANGUAGE_HIN = 'hin'; //       (Hindi)
    const LANGUAGE_HRV = 'hrv'; // (Croatian)
    const LANGUAGE_HUN = 'hun'; // (Hungarian)
    const LANGUAGE_IKU = 'iku'; // (Inuktitut)
    const LANGUAGE_IND = 'ind'; // (Indonesian)
    const LANGUAGE_ISL = 'isl'; // (Icelandic)
    const LANGUAGE_ITA = 'ita'; // (Italian)
    const LANGUAGE_ITA_ = 'ita_old'; //  (Italian - Old)
    const LANGUAGE_JAV = 'jav'; // Javanese)
    const LANGUAGE_JPN = 'jpn'; // (Japanese)
    const LANGUAGE_KAN = 'kan'; // (Kannada)
    const LANGUAGE_KAT = 'kat'; // (Georgian)
    const LANGUAGE_KAT_OLD = 'kat_old'; //  (Georgian - Old)
    const LANGUAGE_KAZ = 'kaz'; // Kazakh)
    const LANGUAGE_KHM = 'khm'; // (Central Khmer)
    const LANGUAGE_KIR = 'kir'; // (Kirghiz; Kyrgyz)
    const LANGUAGE_KOR = 'kor'; // (Korean)
    const LANGUAGE_KUR = 'kur'; // (Kurdish)
    const LANGUAGE_LAO = 'lao'; // (Lao)
    const LANGUAGE_LAT = 'lat'; // (Latin)
    const LANGUAGE_LAV = 'lav'; // (Latvian)
    const LANGUAGE_LIT = 'lit'; // (Lithuanian)
    const LANGUAGE_MAL = 'mal'; // (Malayalam)
    const LANGUAGE_MAR = 'mar'; // (Marathi)
    const LANGUAGE_MKD = 'mkd'; // (Macedonian)
    const LANGUAGE_MLT = 'mlt'; // (Maltese)
    const LANGUAGE_MSA = 'msa'; // (Malay)
    const LANGUAGE_MYA = 'mya'; // (Burmese)
    const LANGUAGE_NEP = 'nep'; // (Nepali)
    const LANGUAGE_NLD = 'nld'; // (Dutch; Flemish)
    const LANGUAGE_NOR = 'nor'; // (Norwegian)
    const LANGUAGE_ORI = 'ori'; // (Oriya)
    const LANGUAGE_OSD = 'osd'; // (Orientation and script detection module)
    const LANGUAGE_PAN = 'pan'; // (Panjabi; Punjabi)
    const LANGUAGE_POL = 'pol'; // (Polish)
    const LANGUAGE_POR = 'por'; //       (Portuguese)
    const LANGUAGE_PUS = 'pus'; // (Pushto; Pashto)
    const LANGUAGE_RON = 'ron'; // (Romanian; Moldavian; Moldovan)
    const LANGUAGE_RUS = 'rus'; // (Russian)
    const LANGUAGE_SAN = 'san'; // (Sanskrit)
    const LANGUAGE_SIN = 'sin'; // (Sinhala; Sinhalese)
    const LANGUAGE_SLK = 'slk'; // (Slovak)
    const LANGUAGE_SLK_FRAK = 'slk_frak'; // (Slovak - Fraktur)
    const LANGUAGE_SLV = 'slv'; // Slovenian)
    const LANGUAGE_SPA = 'spa'; // (Spanish;       Castilian)
    const LANGUAGE_SPA_OLD = 'spa_old'; // ld (Spanish; Castilian - Old)
    const LANGUAGE_SQI = 'sqi'; // Albanian) srp (Serbian)
    const LANGUAGE_TUR = 'tur'; // (Turkish)
    const LANGUAGE_UIG = 'uig'; // (Uighur; Uyghur)
    const LANGUAGE_UKR = 'ukr'; // (Ukrainian)
    const LANGUAGE_URD = 'urd'; // (Urdu)
    const LANGUAGE_UZB = 'uzb'; // (Uzbek)
    const LANGUAGE_UZB_CYRL = 'uzb_cyrl'; // (Uzbek - Cyrilic)
    const LANGUAGE_VIE = 'vie'; // Vietnamese)
    const LANGUAGE_YID = 'yid'; // (Yiddish)


    /**
     * @var string
     */
    protected $languages = ['eng'];

    /**
     * Set Tesseract to only run a subset of layout analysis and assume a
     * certain form of image.
     *
     * @var int
     */
    protected $pageSegMode = self::PAGE_SEG_MODE_NONE;

    /**
     * Restricted list of characters known by the OCR.
     *
     * @var string
     */
    protected $whitelist;

    protected $configFile = null;

    public function __construct($binary = 'tesseract')
    {
        $this->binary = $binary;
    }

    public function cleanup()
    {
        parent::cleanup();
    }

    public function buildCommandArguments()
    {
        $arguments = [];
        $arguments[]  = $this->getFile()->getPathname();

        if (!empty($this->getLanguages())) {
            $arguments[]  = '-l';
            $arguments[]  = implode('+', $this->getLanguages());
        }

        if (!is_null($this->getPageSegMode())) {
            $arguments[]  = '-psm';
            $arguments[]  = $this->getPageSegMode();
        }

        $arguments[]  = 'stdout';

        $arguments[]  = 'quiet';

        $this->generateConfigFile();
        if ($this->getConfigFile()) {
            $arguments[]  = 'nobatch';
            $arguments[]  = $this->getConfigFile();
        }

        return $arguments;
    }

    public function getVersion()
    {
        return $this->execute(['--version']);
    }

    /**
     * Restricts the characters list known by the OCR.
     *
     * @return Tesseract
     */
    public function setWhitelist()
    {
        $this->whitelist = $this->buildWhitelistString(func_get_args());

        return $this;
    }

    /**
     * @return string
     */
    public function getWhitelist()
    {
        return $this->whitelist;
    }

    /**
     * Flatten the lists of characters into a single string.
     *
     * @param array $charLists Lists of chars the OCR should look for
     *
     * @return string
     */
    protected function buildWhitelistString($charLists)
    {
        $whiteList = '';
        foreach ($charLists as $list) {
            $whiteList .= is_array($list) ? implode('', $list) : $list;
        }

        return $whiteList;
    }

    /**
     * Generates a temporary tesseract configuration file to be used on the
     * recognition process.
     */
    protected function generateConfigFile()
    {
        $content = [];
        if ($this->whitelist) {
            $content[] = sprintf('tessedit_char_whitelist %s', $this->whitelist);
        }

        if ( !empty($content)) {
            $this->configFile = $this->generateTmpFile('conf');
            file_put_contents($this->configFile, implode("\n", $content));
        }
    }

    /**
     * @return int
     */
    public function getPageSegMode()
    {
        return $this->pageSegMode;
    }

    /**
     * @param int $pageSegMode
     *
     * @return Tesseract
     */
    public function setPageSegMode($pageSegMode)
    {
        if ($pageSegMode < 0 || $pageSegMode > 10) {
            throw new \InvalidArgumentException('Page seg mode must be between 0 and 10');
        }

        $this->pageSegMode = $pageSegMode;

        return $this;
    }

    /**
     */
    public function getConfigFile()
    {
        return $this->configFile;
    }
}
