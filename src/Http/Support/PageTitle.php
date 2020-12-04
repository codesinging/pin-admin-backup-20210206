<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Support;

trait PageTitle
{
    /**
     * @var string
     */
    protected $pageTitle;

    /**
     * Get page title.
     * @param bool $withBaseName
     * @return string
     */
    protected function pageTitle(bool $withBaseName = true)
    {
        $baseName = admin_config('name', admin()->name());
        if (empty($this->pageTitle)) {
            return $baseName;
        }

        return $this->pageTitle . ($withBaseName ? ' - ' . $baseName : '');
    }

    /**
     * Set page title.
     * @param string $pageTitle
     * @return $this
     */
    protected function setPageTitle(string $pageTitle)
    {
        $this->pageTitle = $pageTitle;
        return $this;
    }
}