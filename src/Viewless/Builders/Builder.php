<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Builders;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Attribute;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use CodeSinging\PinAdmin\Viewless\Foundation\Content;
use CodeSinging\PinAdmin\Viewless\Foundation\Css;
use CodeSinging\PinAdmin\Viewless\Foundation\Style;
use Illuminate\Config\Repository;
use Illuminate\Support\Str;

class Builder extends Buildable
{
    /**
     * The builder's base tag.
     *
     * @var string
     */
    protected $baseTag = '';

    /**
     * The builder tag's prefix.
     *
     * @var string
     */
    protected $tagPrefix = '';

    /**
     * If the builder has a closing tag.
     *
     * @var bool
     */
    protected $closing = true;

    /**
     * If the builder has linebreak between the opening tag, content and the closing tag.
     *
     * @var bool
     */
    protected $linebreak = false;

    /**
     * The Css instance.
     *
     * @var Css
     */
    public $css;

    /**
     * The Style instance.
     *
     * @var Style
     */
    public $style;

    /**
     * The Attribute instance.
     *
     * @var Attribute
     */
    public $attribute;

    /**
     * The builder's initial attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The property instance.
     *
     * @var Repository
     */
    public $property;

    /**
     * The initial properties.
     *
     * @var array
     */
    protected $properties = [];

    /**
     * The builder configuration repository.
     *
     * @var Repository
     */
    public $config;

    /**
     * The builder's initial configuration.
     *
     * @var array
     */
    protected $configs = [];

    /**
     * The Content instance.
     *
     * @var Content
     */
    public $content;

    /**
     * The methods of properties called from `__call`.
     *
     * @var array
     */
    protected $methods = [];

    /**
     * The shortcut methods of properties called from `__call`.
     *
     * @var array
     */
    protected $shortcutMethods = [];

    /**
     * The Vue events called from `__call`.
     *
     * @var array
     */
    protected $events = [];

    /**
     * The slot methods called from `__call`.
     * @var array
     */
    protected $slots = [];

    /**
     * The namespace in the view's data.
     * @var string
     */
    public static $dataNamespace = 'builders';

    /**
     * The builder index.
     *
     * @var int
     */
    protected static $builderCount = 0;

    /**
     * The builder index.
     *
     * @var string
     */
    protected $builderIndex;

    /**
     * The builder id.
     *
     * @var string
     */
    protected $builderId;

    /**
     * All the builders.
     *
     * @var Builder[]
     */
    protected static $builders = [];

    /**
     * Whether the builder is buildable.
     *
     * @var bool
     */
    protected $buildable = true;

    /**
     * Builder constructor.
     * @param string|array|null $tag
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $closing
     * @param bool|null $linebreak
     */
    public function __construct($tag = null, $attributes = null, $content = null, bool $closing = null, bool $linebreak = null)
    {
        self::$builderCount += 1;
        $this->builderIndex = self::$builderCount;

        if (is_string($tag)) {
            $this->setBaseTag($tag);
        } elseif (is_array($tag)) {
            $attributes = $tag;
        }

        if (is_string($attributes)) {
            $content = $attributes;
            $attributes = null;
        }

        is_bool($closing) and $this->closing($closing);
        is_bool($linebreak) and $this->linebreak($linebreak);

        $this->css = new Css();
        $this->style = new Style();

        $this->attribute = new Attribute($this->attributes, $attributes);
        $this->property = new Repository($this->properties);
        $this->config = new Repository($this->configs);
        $this->content = new Content($content);

        $this->initialize();
    }

    /**
     * Initialize the builder.
     */
    protected function initialize(): void
    {
    }

    /**
     * Set builder's base tag.
     * @param string $baseTag
     *
     * @return $this
     */
    protected function setBaseTag(string $baseTag)
    {
        $this->baseTag = $baseTag;
        return $this;
    }

    /**
     * Get builder base tag.
     *
     * @return string
     */
    public function getBaseTag()
    {
        return $this->baseTag ?: $this->autoBaseTag();
    }

    /**
     * Get builder's full tag.
     *
     * @return string
     */
    public function getFullTag()
    {
        return $this->tagPrefix . $this->getBaseTag();
    }

    /**
     * Get the automatic base tag based on class name.
     *
     * @return string
     */
    protected function autoBaseTag()
    {
        $basename = basename(str_replace('\\', '/', get_class($this)));
        return Str::kebab($basename);
    }

    /**
     * Set builder's closing attribute.
     *
     * @param bool $closing
     *
     * @return $this
     */
    public function closing(bool $closing = true)
    {
        $this->closing = $closing;
        return $this;
    }

    /**
     * Set builder's linebreak attribute.
     *
     * @param bool $linebreak
     *
     * @return $this
     */
    public function linebreak(bool $linebreak = true)
    {
        $this->linebreak = $linebreak;
        return $this;
    }

    /**
     * Add css classes.
     *
     * @param string|array|Css|Closure ...$classes
     *
     * @return Css|$this
     */
    public function css(...$classes)
    {
        if (empty($classes)) {
            return $this->css;
        }
        $this->css->add(...$classes);
        return $this;
    }

    /**
     * Add styles or get Style instance.
     *
     * @param string|array|Style|Closure ...$styles
     *
     * @return Style|$this
     */
    public function style(...$styles)
    {
        if (empty($styles)) {
            return $this->style;
        }
        $this->style->add(...$styles);
        return $this;
    }

    /**
     * Set or get attribute value.
     * Get the Attribute instance.
     *
     * @param null|string|array $key
     * @param mixed $value
     *
     * @return $this|Attribute|mixed
     */
    public function attr($key = null, $value = null)
    {
        if (is_null($key)) {
            return $this->attribute;
        }

        if (is_string($key)) {
            return $this->attribute->get($key, $value);
        }

        if (is_array($key)) {
            $this->attribute->set($key);
            return $this;
        }

        return $this->attribute;
    }

    /**
     * Set given attribute values.
     *
     * @param array|string $key
     * @param mixed $value
     *
     * @return $this
     */
    public function setAttr($key, $value = null)
    {
        $this->attribute->set($key, $value);
        return $this;
    }

    /**
     * Get the specified attribute value.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function getAttr(string $key, $default = null)
    {
        return $this->attribute->get($key, $default);
    }

    /**
     * Get all attributes items of the builder.
     *
     * @return array
     */
    public function attributes()
    {
        return $this->attribute->all();
    }

    /**
     * Set property values.
     *
     * @param array|string $key
     * @param mixed $value
     *
     * @return $this
     */
    public function set($key, $value = null)
    {
        $this->property->set($key, $value);
        return $this;
    }

    /**
     * Get the specified property value.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return array|mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->property->get($key, $default);
    }

    /**
     * Get property key.
     * @param string|null $key
     * @return string
     */
    public function propertyKey(string $key = null)
    {
        $key = 'properties' . ($key ? '.' . $key : '');
        return $this->dataKey($key);
    }

    /**
     * Get all properties of the builder.
     *
     * @return array
     */
    public function properties()
    {
        return $this->property->all();
    }

    /**
     * Set/get configuration value or get the configuration repository instance.
     *
     * @param null|string|array $key
     * @param mixed $value
     *
     * @return $this|Repository|mixed
     */
    public function config($key = null, $value = null)
    {
        if (is_null($key)) {
            return $this->config;
        }

        if (is_string($key)) {
            return $this->config->get($key, $value);
        }

        if (is_array($key)) {
            $this->config->set($key);
            return $this;
        }

        return $this->config;
    }

    /**
     * Set configuration values.
     *
     * @param array|string $key
     * @param null $value
     *
     * @return $this
     */
    public function setConfig($key, $value = null)
    {
        $this->config->set($key, $value);
        return $this;
    }

    /**
     * Get the specified configuration value.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return array|mixed
     */
    public function getConfig(string $key, $default = null)
    {
        return $this->config->get($key, $default);
    }

    /**
     * Get configuration key.
     * @param string|null $key
     * @return string
     */
    public function configKey(string $key = null)
    {
        $key = 'configs' . ($key ? '.' . $key : '');
        return $this->dataKey($key);
    }

    /**
     * Get all configurations.
     *
     * @return array
     */
    public function configs()
    {
        return $this->config->all();
    }

    /**
     * Add contents to the content flow.
     *
     * @param string|array|Buildable|Closure ...$contents
     *
     * @return $this
     */
    public function add(...$contents)
    {
        $this->content->add(...$contents);
        return $this;
    }

    /**
     * Prepend contents to the beginning of the content flow.
     *
     * @param string|array|Buildable|Closure ...$contents
     *
     * @return $this
     */
    public function prepend(...$contents)
    {
        $this->content->prepend(...$contents);
        return $this;
    }

    /**
     * Add a interpolation content to the content flow.
     *
     * @param string $content
     *
     * @return $this
     */
    public function interpolation(string $content)
    {
        $this->add(sprintf('{{ %s }}', $content));
        return $this;
    }

    /**
     * Add a named slot content to the content flow.
     *
     * @param string $name
     * @param string|array|Builder|Buildable|Closure $content
     * @param string $tag
     *
     * @return $this
     */
    public function slot(string $name, $content, $tag = 'template')
    {
        if ($content instanceof Closure) {
            $content = call_closure($content, new Content());
        }

        if (is_string($content) || is_array($content)) {
            $content = (new Builder(['slot' => $name]))->setBaseTag($tag)->add($content);
        } elseif ($content instanceof Builder) {
            $content->setAttr('slot', $name);
        } else {
            $content = (new Builder(['slot' => $name]))->setBaseTag($tag)->add((string)$content);
        }

        $this->add($content);

        return $this;
    }

    /**
     * Get the builder's contents.
     * @return string
     */
    public function contents()
    {
        return $this->content->build();
    }

    /**
     * Add a `v-bind` directive.
     * @param array|string $name
     * @param mixed|null $value
     * @return $this
     */
    public function vBind($name, $value = null)
    {
        if (is_string($name)) {
            $name = [$name => $value];
        }

        if (is_array($name)) {
            foreach ($name as $key => $val) {
                $key = Str::start($key, ':');
                $this->setAttr($key, $val);
            }
        }

        return $this;
    }

    /**
     * Add a `v-on` directive.
     * @param string|array $event
     * @param string|null $handler
     * @return $this
     */
    public function vOn($event, string $handler = null)
    {
        if (is_string($event)) {
            $event = [$event => $handler];
        }

        if (is_array($event)) {
            foreach ($event as $key => $value) {
                $key = Str::start($key, '@');
                $this->setAttr($key, $value);
            }
        }

        return $this;
    }

    /**
     * Add a `v-on:click` directive.
     * @param string $handler
     * @param string|null $modifier
     * @return $this
     */
    public function vClick(string $handler, string $modifier = null)
    {
        $event = 'click' . ($modifier ? '.' . $modifier : '');
        return $this->vOn($event, $handler);
    }

    /**
     * Add a `v-on` directive which assign a value to a property.
     * @param string $name
     * @param mixed $value
     * @param string $event
     * @return $this
     */
    public function vAssign(string $name, $value, string $event = 'click')
    {
        if ($value === true) {
            $value = 'true';
        } elseif ($value === false) {
            $value = 'false';
        }

        $handler = sprintf('%s = %s', $name, $value);
        return $this->vOn($event, $handler);
    }

    /**
     * Add a `v-model` directive.
     * @param string $model
     * @param string|null $modifier
     * @return $this
     */
    public function vModel(string $model, string $modifier = null)
    {
        $key = 'v-model' . ($modifier ? '.' . $modifier : '');
        $this->setAttr($key, $model);
        return $this;
    }

    /**
     * Add a `v-text` directive.
     *
     * @param string $value
     *
     * @return $this
     */
    public function vText(string $value)
    {
        $this->setAttr('v-text', $value);
        return $this;
    }

    /**
     * Add a `v-html` directive.
     *
     * @param string $value
     *
     * @return $this
     */
    public function vHtml(string $value)
    {
        $this->setAttr('v-html', $value);
        return $this;
    }

    /**
     * Add a `v-show` directive.
     *
     * @param string $value
     *
     * @return $this
     */
    public function vShow(string $value)
    {
        $this->setAttr('v-show', $value);
        return $this;
    }

    /**
     * Add a `v-if` directive.
     *
     * @param string $value
     *
     * @return $this
     */
    public function vIf(string $value)
    {
        $this->setAttr('v-if', $value);
        return $this;
    }

    /**
     * Add a `v-else-if` directive.
     *
     * @param string $value
     *
     * @return $this
     */
    public function vElseIf(string $value)
    {
        $this->setAttr('v-else-if', $value);
        return $this;
    }

    /**
     * Add a `v-else` directive.
     *
     * @return $this
     */
    public function vElse()
    {
        $this->setAttr('v-else', null);
        return $this;
    }

    /**
     * Add a `v-for` directive.
     *
     * @param string $value
     *
     * @return $this
     */
    public function vFor(string $value)
    {
        $this->setAttr('v-for', $value);
        return $this;
    }

    /**
     * Add a `v-loading` directive.
     *
     * @param string $value
     *
     * @return $this
     */
    public function vLoading(string $value)
    {
        $this->setAttr('v-loading', $value);
        return $this;
    }

    /**
     * Add ref attribute.
     *
     * @param string|null $name
     *
     * @return $this
     */
    public function ref(string $name = null)
    {
        $this->setAttr('ref', $name ?? $this->builderId());
        return $this;
    }

    /**
     * The methods to set properties or events.
     *
     * @param string $method
     * @param array $arguments
     *
     * @return $this
     */
    public function __call(string $method, array $arguments)
    {
        if ($this->methods && in_array($method, $this->methods)) {
            $this->set(Str::kebab($method), $arguments[0] ?? true);
            return $this;
        }

        if ($this->shortcutMethods) {
            foreach ($this->shortcutMethods as $shortcutMethod) {
                if (Str::startsWith($method, $shortcutMethod . 'As')) {
                    $this->set(Str::kebab($shortcutMethod), lcfirst(Str::after($method, $shortcutMethod . 'As')));
                    return $this;
                }
            }
        }

        if ($this->events) {
            foreach ($this->events as $event) {
                if ($method === 'on' . ucfirst($event)) {
                    if (count($arguments) > 1) {
                        $handler = $arguments[0] . '(';
                        array_shift($arguments);
                        $handler .= implode(', ', $arguments);
                        $handler .= ')';
                    } else {
                        $handler = $arguments[0] ?? $method;
                    }
                    $this->setAttr(Str::start(Str::kebab($event), '@'), $handler);
                    return $this;
                }
            }
        }

        if ($this->slots) {
            foreach ($this->slots as $slot) {
                if ($method === 'slotNamed' . ucfirst($slot)) {
                    $this->slot(lcfirst(Str::after($method, 'slotNamed')), ...$arguments);
                    return $this;
                }
            }
        }

        return $this;
    }

    /**
     * Get builder count.
     *
     * @return int
     */
    public function builderCount()
    {
        return self::$builderCount;
    }

    /**
     * Get builder index.
     *
     * @return string
     */
    public function builderIndex()
    {
        return $this->builderIndex;
    }

    /**
     * Get builder id.
     *
     * @return string
     */
    public function builderId()
    {
        return $this->builderId ?? $this->autoBuilderId();
    }

    /**
     * Automatic build id.
     * @return string
     */
    protected function autoBuilderId()
    {
        return sprintf('comp_%s_%s', $this->builderIndex(), str_replace('-', '_', $this->getFullTag()));
    }

    /**
     * Set builder id.
     *
     * @param string $builderId
     *
     * @return $this
     */
    public function setBuilderId(string $builderId)
    {
        $this->builderId = $builderId;
        return $this;
    }

    /**
     * Get the key of the data in the view.
     * @param string|null $path
     * @return string
     */
    public function dataKey(string $path = null)
    {
        return self::$dataNamespace . '.' . $this->builderId() . ($path ? '.' . $path : '');
    }

    /**
     * Determine whether the builder is buildable.
     *
     * @param bool $buildable
     * @return $this
     */
    public function buildable(bool $buildable = true)
    {
        $this->buildable = $buildable;
        return $this;
    }

    /**
     * Whether the builder is buildable.
     *
     * @return bool
     */
    public function isBuildable()
    {
        return $this->buildable;
    }

    /**
     * Ready to build the builder.
     */
    protected function ready(): void
    {
    }

    /**
     * Get all the builders.
     *
     * @return Builder[]
     */
    public static function builders()
    {
        return self::$builders;
    }

    /**
     * Build content as a string of the object.
     *
     * @return string
     */
    public function build()
    {
        if ($this->isBuildable()) {

            $this->ready();

            self::$builders[] = $this;

            if (!$this->css->isEmpty()) {
                $this->setAttr('class', $this->css->build());
            }
            if (!$this->style->isEmpty()) {
                $this->setAttr('style', $this->style->build());
            }

            if (!empty($this->properties())) {
                $this->setAttr('v-bind', $this->dataKey('properties'));
            }

            $this->attribute->placeholder([
                '*.' => $this->dataKey() . '.',
                '\*\.' => '*.',
                '@.' => $this->propertyKey() . '.',
                '\@\.' => '@.',
                '#.' => $this->configKey() . '.',
                '\#\.' => '#.',
            ]);

            if ($this->linebreak) {
                $this->content->linebreak();
            }

            $builder = sprintf(
                '<%s%s>%s%s%s%s',
                $this->getFullTag(),
                $this->attribute->isEmpty() ? '' : ' ' . $this->attribute->build(),
                $this->linebreak && !$this->content->isEmpty() ? PHP_EOL : '',
                $this->content->build(),
                $this->linebreak && $this->closing ? PHP_EOL : '',
                $this->closing ? '</' . $this->getFullTag() . '>' : ''
            );
        } else {
            $builder = '';
        }

        return $builder;
    }
}