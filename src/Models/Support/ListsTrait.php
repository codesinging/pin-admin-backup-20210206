<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Models\Support;

use Closure;

trait ListsTrait
{
    /**
     * Get lists.
     * @param Closure|null $query
     * @param Closure|null $handler
     * @return array
     */
    public function lists(Closure $query = null, Closure $handler = null)
    {
        $builder = $this->newQuery();

        if ($query instanceof Closure){
            $builder = $query($builder);
        }

        $page = intval(request('page', 0));
        $size = intval(request('size', 0));
        $pageable = $page>0;

        if ($pageable){
            $pagination = $builder->paginate($size)->toArray();

            $lists = [
                'page' => $pagination['current_page'],
                'size' => (int) $pagination['per_page'],
                'total' => $pagination['total'],
                'data' => $pagination['data'],
            ];
        } else {
            $data = $builder->get()->toArray();
            $count = count($data);

            $lists = [
                'page' => $page,
                'size' => $count,
                'total' => $count,
                'data' => $data
            ];
        }

        if ($handler instanceof Closure){
            foreach ($lists['data'] as $key => &$item) {
                $item = $handler($item, $key, $lists);
            }
        }

        return $lists;
    }
}