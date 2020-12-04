<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Http\Support;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

trait ViewResponses
{
    /**
     * Get the base view data.
     * @return array
     */
    protected function baseData()
    {
        return [
            'baseUrl' => admin_link(),
            'adminUser' => admin_user(),
            'pageTitle' => $this->pageTitle(),
        ];
    }

    /**
     * Get the evaluated view contents for the given view.
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return Factory|View
     */
    protected function view(string $view, array $data = [], array $mergeData = [])
    {
        return view($view, $data, $mergeData)->with('baseData', $this->baseData());
    }

    /**
     * Get the evaluated view contents for the given view of PinAdmin.
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return Factory|View
     */
    protected function adminView(string $view, array $data = [], array $mergeData = [])
    {
        return admin_view($view, $data, $mergeData)->with('baseData', $this->baseData());
    }
}