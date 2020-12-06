<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Builders;

use CodeSinging\PinAdmin\Viewless\Builders\Builder;
use CodeSinging\PinAdmin\Viewless\Foundation\Attribute;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use CodeSinging\PinAdmin\Viewless\Foundation\Content;
use CodeSinging\PinAdmin\Viewless\Foundation\Css;
use CodeSinging\PinAdmin\Viewless\Foundation\Style;
use Illuminate\Config\Repository;
use Orchestra\Testbench\TestCase;

class BuilderTest extends TestCase
{
    public function testClassAttributeAboutBaseTag()
    {
        self::assertEquals('<span></span>', new TestSpanBuilder());
    }

    public function testClassAttributeAboutTagPrefix()
    {
        self::assertEquals('<el-button></el-button>', new TestTagPrefixBuilder('button'));
    }

    public function testClassAttributeAboutClosing()
    {
        self::assertEquals('<builder></builder>', new Builder());
        self::assertEquals('<input>', (new TestClosingBuilder('input'))->build());
    }

    public function testClassAttributeAboutLinebreak()
    {
        self::assertEquals('<div></div>', new Builder('div'));
        self::assertEquals('<div>' . PHP_EOL . '</div>', new TestLinebreakBuilder('div'));
    }

    public function testClassAttributeAboutCss()
    {
        self::assertInstanceOf(Css::class, (new Builder())->css);
    }

    public function testClassAttributeAboutStyle()
    {
        self::assertInstanceOf(Style::class, (new Builder())->style);
    }

    public function testClassAttributeAboutAttribute()
    {
        self::assertInstanceOf(Attribute::class, (new Builder())->attribute);
    }

    public function testClassAttributeAboutAttributes()
    {
        self::assertEquals('<div id="app"></div>', new TestAttributesBuilder('div'));
    }

    public function testClassAttributeAboutProperty()
    {
        self::assertInstanceOf(Repository::class, (new Builder())->property);
    }

    public function testClassAttributeAboutProperties()
    {
        $builder = new TestPropertiesBuilder('div');
        self::assertEquals('<div v-bind="' . $builder->dataKey('properties') . '"></div>', $builder->build());
        self::assertEquals(['id' => 1], $builder->properties());
    }

    public function testClassAttributeAboutConfig()
    {
        self::assertInstanceOf(Repository::class, (new Builder())->config);
    }

    public function testClassAttributeAboutConfigs()
    {
        self::assertEquals(['id' => 1], (new TestConfigsBuilder())->configs());
    }

    public function testClassAttributeAboutContent()
    {
        self::assertInstanceOf(Content::class, (new Builder())->content);
    }

    public function testConstructorWhenTagIsNull()
    {
        self::assertEquals('<builder></builder>', new Builder());
    }

    public function testConstructorWhenTagIsString()
    {
        self::assertEquals('<div></div>', new Builder('div'));
    }

    public function testConstructorWhenTagIsArray()
    {
        self::assertEquals('<builder id="app"></builder>', new Builder(['id' => 'app']));
    }

    public function testConstructorWhenAttributesIsArray()
    {
        self::assertEquals('<div id="app"></div>', new Builder('div', ['id' => 'app']));
    }

    public function testConstructorWhenAttributesIsString()
    {
        self::assertEquals('<div>content</div>', new Builder('div', 'content'));
    }

    public function testConstructorAboutClosing()
    {
        self::assertEquals('<div></div>', new Builder('div', null, null, true));
        self::assertEquals('<div>', new Builder('div', null, null, false));
    }

    public function testConstructorAboutLinebreak()
    {
        self::assertEquals('<div></div>', new Builder('div'));
        self::assertEquals('<div>' . PHP_EOL . '</div>', new Builder('div', null, null, null, true));
        self::assertEquals('<div></div>', new Builder('div', null, null, null, false));
    }

    public function testInitialize()
    {
        self::assertEquals('<span></span>', new TestInitializeBuilder());
    }

    public function testSetBaseTag()
    {
        self::assertEquals('<span></span>', new TestInitializeBuilder());
    }

    public function testGetBaseTag()
    {
        self::assertEquals('builder', (new Builder())->getBaseTag());
        self::assertEquals('span', (new TestSpanBuilder())->getBaseTag());
    }

    public function testGetFullTag()
    {
        self::assertEquals('builder', (new Builder())->getBaseTag());
        self::assertEquals('el-button', (new TestTagPrefixBuilder('button'))->getFullTag());
    }

    public function testAutoBaseTag()
    {
        self::assertEquals('builder', (new Builder())->getBaseTag());
        self::assertEquals('test-auto-base-tag', (new TestAutoBaseTag())->getBaseTag());
    }

    public function testClosing()
    {
        self::assertEquals('<div>', (new Builder('div'))->closing(false));
    }

    public function testLinebreak()
    {
        self::assertEquals('<div>' . PHP_EOL . '</div>', (new Builder('div'))->linebreak());
    }

    public function testCssWithoutParameters()
    {
        self::assertInstanceOf(Css::class, (new Builder())->css());
    }

    public function testCssWithParameters()
    {
        self::assertEquals('<div class="p"></div>', (new Builder('div'))->css('p'));
        self::assertEquals('<div class="p m"></div>', (new Builder('div'))->css('p', 'm'));
    }

    public function testStyleWithoutParameters()
    {
        self::assertInstanceOf(Style::class, (new Builder())->style());
    }

    public function testStyleWithParameters()
    {
        self::assertEquals('<div style="width:1px;"></div>', (new Builder('div'))->style(['width' => '1px'])->build());
        self::assertEquals('<div style="width:1px; height:1px;"></div>', (new Builder('div'))->style(['width' => '1px'], ['height' => '1px'])->build());
    }

    public function testAttrWhenKeyIsNull()
    {
        self::assertInstanceOf(Attribute::class, (new Builder())->attr());
    }

    public function testAttrWhenKeyIsString()
    {
        self::assertEquals('app', (new Builder(['id' => 'app']))->attr('id'));
    }

    public function testAttrWhenKeyIsArray()
    {
        self::assertEquals('app', (new Builder())->attr(['id' => 'app'])->attr('id'));
    }

    public function testGetAttr()
    {
        self::assertEquals('app', (new Builder(['id' => 'app']))->getAttr('id'));
    }

    public function testSetAttr()
    {
        self::assertEquals('app', (new Builder())->setAttr(['id' => 'app'])->attr('id'));
    }

    public function testAttributes()
    {
        self::assertEquals(['name' => 'Name',], (new Builder(['name' => 'Name',]))->attributes());
    }

    public function testSetProp()
    {
        self::assertEquals(['id' => 1], (new Builder())->set(['id' => 1])->properties());
        self::assertEquals(['id' => 1], (new Builder())->set('id', 1)->properties());
    }

    public function testGetProp()
    {
        self::assertEquals(1, (new TestPropertiesBuilder())->get('id'));
    }

    public function testPropertyKey()
    {
        $builder = new Builder();
        self::assertEquals('builders.' . $builder->builderId() . '.properties', $builder->propertyKey());
        self::assertEquals('builders.' . $builder->builderId() . '.properties.name', $builder->propertyKey('name'));
    }

    public function testProperties()
    {
        self::assertEquals(['id' => 1], (new Builder())->set('id', 1)->properties());
    }

    public function testConfigWhenKeyIsNull()
    {
        self::assertInstanceOf(Repository::class, (new Builder())->config());
    }

    public function testConfigWhenKeyIsString()
    {
        self::assertEquals(1, (new TestConfigsBuilder())->config('id'));
        self::assertEquals(2, (new TestConfigsBuilder())->config('age', 2));
    }

    public function testConfigWhenKeyIsArray()
    {
        self::assertEquals(['id' => 1], (new Builder())->config(['id' => 1])->configs());
    }

    public function testSetConfig()
    {
        self::assertEquals(['id' => 1], (new Builder())->setConfig(['id' => 1])->configs());
        self::assertEquals(['id' => 1], (new Builder())->setConfig('id', 1)->configs());
    }

    public function testGetConfig()
    {
        self::assertEquals(1, (new TestConfigsBuilder())->getConfig('id'));
    }

    public function testConfigKey()
    {
        $builder = new Builder();
        self::assertEquals(Builder::$dataNamespace . '.' . $builder->builderId() . '.configs', $builder->configKey());
        self::assertEquals(Builder::$dataNamespace . '.' . $builder->builderId() . '.configs.name', $builder->configKey('name'));
    }

    public function testConfigs()
    {
        self::assertEquals(['id' => 1], (new TestConfigsBuilder())->configs());
    }

    public function testAddString()
    {
        self::assertEquals('hello', (new Builder())->add('hello')->contents());
        self::assertEquals('hello world', (new Builder())->add('hello', ' ', 'world')->contents());
    }

    public function testAddArray()
    {
        self::assertEquals('ab', (new Builder())->add(['a', 'b'])->contents());
    }

    public function testAddBuilder()
    {
        self::assertEquals('<div></div>', (new Builder())->add(new Builder('div'))->contents());
    }

    public function testPrepend()
    {
        self::assertEquals('ab', (new Builder('div', null, 'b'))->prepend('a')->contents());
        self::assertEquals('abc', (new Builder('div', null, 'c'))->prepend('a', 'b')->contents());
        self::assertEquals('abc', (new Builder('div', null, 'c'))->prepend('b')->prepend('a')->contents());
    }

    public function testInterpolation()
    {
        self::assertEquals('{{ title }}', (new Builder())->interpolation('title')->contents());
    }

    public function testSlotWhenContentIsString()
    {
        self::assertEquals('<template slot="title">Title</template>', (new Builder())->slot('title', 'Title')->contents());
    }

    public function testSlotWhenContentIsArray()
    {
        self::assertEquals(
            '<template slot="title">hello world</template>',
            (new Builder())->slot('title', ['hello', ' ', 'world'])->contents()
        );
    }

    public function testSlotWhenContentIsBuildable()
    {
        self::assertEquals(
            '<template slot="title">hello world</template>',
            (new Builder())->slot('title', new TestSlotWhenContentIsBuildableBuilder())->contents()
        );
    }

    public function testSlotWhenContentIsBuilder()
    {
        self::assertEquals(
            '<div slot="title">hello</div>',
            (new Builder())->slot('title', (new Builder('div'))->add('hello'))->contents()
        );
    }

    public function testSlotWhenContentIsClosure()
    {
        $element = (new Builder('div'))->slot("header", function () {
            return "title";
        });
        self::assertEquals("<div><template slot=\"header\">title</template></div>", $element->build());

        $element = (new Builder('div'))->slot("header", function (Content $content) {
            return $content->add("title");
        });
        self::assertEquals("<div><template slot=\"header\">title</template></div>", $element->build());

        $element = (new Builder('div'))->slot("header", function (Content $content) {
            $content->add("title");
        });
        self::assertEquals("<div><template slot=\"header\">title</template></div>", $element->build());
    }

    public function testContents()
    {
        self::assertEquals('hello', (new Builder())->add('hello')->contents());
    }

    public function testVBind()
    {
        self::assertEquals("<builder :id=\"1\"></builder>", (new Builder())->vBind('id', 1)->build());
        self::assertEquals("<builder :visible.sync=\"visible\"></builder>", (new Builder())->vBind('visible.sync', 'visible')->build());
        self::assertEquals("<builder :id=\"1\" :name=\"Name\"></builder>", (new Builder())->vBind(['id' => 1, 'name' => 'Name'])->build());
    }

    public function testVOn()
    {
        self::assertEquals("<builder @click=\"onClick\"></builder>", (new Builder())->vOn('click', 'onClick')->build());
        self::assertEquals("<builder @click.native=\"onClick\"></builder>", (new Builder())->vOn('click.native', 'onClick')->build());
        self::assertEquals("<builder @click=\"click\" @hover=\"onHover\"></builder>", (new Builder())->vOn(['click' => 'click', 'hover' => 'onHover'])->build());
    }

    public function testVClick()
    {
        self::assertEquals("<builder @click=\"onClick\"></builder>", (new Builder())->vClick('onClick'));
        self::assertEquals("<builder @click.native=\"onClick\"></builder>", (new Builder())->vClick('onClick', 'native'));
    }

    public function testVAssign()
    {
        self::assertEquals("<builder @click=\"disabled = true\"></builder>", (new Builder())->vAssign('disabled', true));
        self::assertEquals("<builder @click=\"disabled = false\"></builder>", (new Builder())->vAssign('disabled', false));
        self::assertEquals("<builder @click=\"age = 20\"></builder>", (new Builder())->vAssign('age', 20));
        self::assertEquals("<builder @click=\"name = \"app\"\"></builder>", (new Builder())->vAssign('name', '"app"')->build());
        self::assertEquals("<builder @dblclick=\"disabled = false\"></builder>", (new Builder())->vAssign('disabled', false, 'dblclick'));
    }

    public function testVModel()
    {
        self::assertEquals("<builder v-model=\"name\">", (new Builder())->closing(false)->vModel('name'));
        self::assertEquals("<builder v-model.number=\"age\">", (new Builder())->closing(false)->vModel('age', 'number'));
    }

    public function testVText()
    {
        self::assertEquals("<builder v-text=\"ok\"></builder>", (new Builder())->vText('ok'));
    }

    public function testVHtml()
    {
        self::assertEquals("<builder v-html=\"ok\"></builder>", (new Builder())->vHtml('ok'));
    }

    public function testVShow()
    {
        self::assertEquals("<builder v-show=\"ok\"></builder>", (new Builder())->vShow('ok'));
    }

    public function testVIf()
    {
        self::assertEquals("<builder v-if=\"ok\"></builder>", (new Builder())->vIf('ok'));
    }

    public function testVElseIf()
    {
        self::assertEquals("<builder v-else-if=\"ok\"></builder>", (new Builder())->vElseIf('ok'));
    }

    public function testVElse()
    {
        self::assertEquals("<builder v-else></builder>", (new Builder())->vElse());
    }

    public function testVFor()
    {
        self::assertEquals("<builder v-for=\"item in items\"></builder>", (new Builder())->vFor('item in items'));
    }

    public function testVLoading()
    {
        self::assertEquals("<builder v-loading=\"ok\"></builder>", (new Builder())->vLoading('ok'));
    }

    public function testRef()
    {
        self::assertEquals("<builder ref=\"table\"></builder>", (new Builder())->ref('table')->build());
    }

    public function testCallProperties()
    {
        self::assertEquals(['disabled' => true], (new TestCallPropertiesBuilder())->disabled()->properties());
    }

    public function testCallShortcutMethod()
    {
        self::assertEquals(['size' => 'mini'], (new TestCallShortcutPropertiesBuilder())->sizeAsMini()->properties());
        self::assertEquals(['size' => 'small'], (new TestCallShortcutPropertiesBuilder())->sizeAsSmall()->properties());
    }

    public function testCallEvent()
    {
        self::assertEquals('<div @click="onClick"></div>', (new TestCallEventsBuilder())->onClick('onClick')->build());
        self::assertEquals('<div @size-change="onSizeChange"></div>', (new TestCallEventsBuilder())->onSizeChange('onSizeChange')->build());
    }

    public function testCallEventWithParameters()
    {
        $builder = new TestCallEventsBuilder();
        self::assertEquals(
            '<div @click="onClick(1)"></div>',
            $builder->onClick('onClick', 1)->build()
        );
        self::assertEquals(
            '<div @click="onClick(1, lists.page)"></div>',
            $builder->onClick('onClick', 1, 'lists.page')->build()
        );
        self::assertEquals(
            '<div @click="onClick(1, \'loading\')"></div>',
            $builder->onClick('onClick', 1, "'loading'")->build()
        );
        self::assertEquals(
            '<div @click="onAdd(\'' . $builder->builderId() . '\')"></div>',
            $builder->onClick('onAdd', "'{$builder->builderId()}'")->build()
        );
        self::assertEquals(
            '<div @click="onAdd(' . $builder->dataKey('id') . ')"></div>',
            $builder->onClick('onAdd', $builder->dataKey('id'))->build()
        );
    }

    public function testCallSlot()
    {
        self::assertEquals(
            '<div><template slot="empty">Empty</template></div>',
            (new testCallSlotsBuilder('div'))->slotNamedEmpty('Empty')
        );
        self::assertEquals(
            '<div><span slot="empty">Empty</span></div>',
            (new testCallSlotsBuilder('div'))->slotNamedEmpty('Empty', 'span')
        );
        self::assertEquals(
            '<div><template slot="prefix">Prefix</template><div slot="empty">Empty</div></div>',
            (new testCallSlotsBuilder('div'))->slotNamedPrefix('Prefix')->slotNamedEmpty(new Builder('div', 'Empty'))
        );
    }

    public function testBuilderCount()
    {
        $builder1 = new Builder();
        $builder2 = new Builder();
        self::assertIsInt($builder1->builderCount());
        self::assertIsInt($builder2->builderCount());

        self::assertEquals($builder2->builderCount(), $builder1->builderCount());
    }

    public function testBuilderIndex()
    {
        $builder1 = new Builder();
        $builder2 = new Builder();
        self::assertIsInt($builder1->builderIndex());
        self::assertIsInt($builder2->builderIndex());

        self::assertEquals($builder2->builderIndex(), $builder1->builderIndex() + 1);
    }

    public function testBuilderId()
    {
        self::assertMatchesRegularExpression("/[a-z][a-z0-9]+/", (new Builder())->builderId());
    }

    public function testAutoBuilderId()
    {
        self::assertMatchesRegularExpression("/comp_[0-9]+_div/", (new Builder('div'))->builderId());
    }

    public function testSetBuilderId()
    {
        self::assertEquals('table', (new Builder())->setBuilderId('table')->builderId());
    }

    public function testDataKey()
    {
        $builder = new Builder('div');

        self::assertEquals(Builder::$dataNamespace . '.' . $builder->builderId(), $builder->dataKey());
        self::assertEquals(Builder::$dataNamespace . '.' . $builder->builderId() . '.properties', $builder->dataKey('properties'));
        self::assertEquals(Builder::$dataNamespace . '.' . $builder->builderId() . '.properties.visible', $builder->dataKey('properties.visible'));
    }

    public function testBuildable()
    {
        self::assertFalse((new Builder())->buildable(false)->isBuildable());
        self::assertTrue((new Builder())->buildable()->isBuildable());
    }

    public function testIsBuildable()
    {
        self::assertTrue((new Builder())->isBuildable());
    }

    public function testReady()
    {
        self::assertEquals('<span></span>', new TestReadyBuilder());
    }

    public function testBuilders()
    {
        $builder = (new Builder('div'))->build();
        self::assertInstanceOf(Builder::class, last(Builder::builders()));
        self::assertEquals($builder, last(Builder::builders()));
    }

    public function testBuildAboutBuildable()
    {
        self::assertEquals('<div></div>', (new Builder('div'))->build());
        self::assertSame('', (new Builder('div'))->buildable(false)->build());
    }

    public function testBuildAboutClassAttribute()
    {
        self::assertEquals('<div class="m p"></div>', (new Builder('div'))->css('m p'));
    }

    public function testBuildAboutStyleAttribute()
    {
        self::assertEquals('<div style="color:red;"></div>', (new Builder('div'))->style(['color' => 'red']));
    }

    public function testBuildAboutProperties()
    {
        $build = (new Builder('div'))->set('id', 1);
        self::assertEquals(
            '<div v-bind="' . Builder::$dataNamespace . '.' . $build->builderId() . '.properties"></div>',
            $build->build()
        );
        self::assertEquals(['id' => 1], $build->properties());
    }

    public function testPlaceholderInConstruct()
    {
        $builder = new Builder('div', [':visible' => '*.visible']);
        self::assertEquals('<div :visible="' . Builder::$dataNamespace . '.' . $builder->builderId() . '.visible"></div>', $builder->build());
    }

    public function testPlaceholderInSetAttr()
    {
        $builder = new Builder('div');
        self::assertEquals('<div :visible="' . Builder::$dataNamespace . '.' . $builder->builderId() . '.visible"></div>', $builder->setAttr(':visible', '*.visible')->build());
    }

    public function testPlaceholderInVBind()
    {
        $builder = new Builder('div');
        self::assertEquals('<div :visible="' . Builder::$dataNamespace . '.' . $builder->builderId() . '.visible"></div>', $builder->vBind('visible', '*.visible')->build());
    }

    public function testPropertyPlaceholder()
    {
        $builder = new Builder('div', [':visible' => '@.visible']);
        self::assertEquals('<div :visible="' . Builder::$dataNamespace . '.' . $builder->builderId() . '.properties.visible"></div>', $builder->build());
    }

    public function testConfigPlaceholder()
    {
        $builder = new Builder('div', [':visible' => '#.visible']);
        self::assertEquals('<div :visible="' . Builder::$dataNamespace . '.' . $builder->builderId() . '.configs.visible"></div>', $builder->build());
    }
}

class TestSpanBuilder extends Builder
{
    protected $baseTag = 'span';
}

class TestTagPrefixBuilder extends Builder
{
    protected $tagPrefix = 'el-';
}

class TestClosingBuilder extends Builder
{
    protected $closing = false;
}

class TestLinebreakBuilder extends Builder
{
    protected $linebreak = true;
}

class TestAttributesBuilder extends Builder
{
    protected $attributes = ['id' => 'app'];
}

class TestPropertiesBuilder extends Builder
{
    protected $properties = ['id' => 1];
}

class TestConfigsBuilder extends Builder
{
    protected $configs = ['id' => 1];
}

class TestInitializeBuilder extends Builder
{
    protected function initialize(): void
    {
        parent::initialize();
        $this->setBaseTag('span');
    }
}

class TestSetBaseTagBuilder extends Builder
{
    protected function initialize(): void
    {
        $this->setBaseTag('span');
    }
}

class TestAutoBaseTag extends Builder
{

}

class TestSlotWhenContentIsBuildableBuilder extends Buildable
{
    public function build()
    {
        return 'hello world';
    }
}

/**
 * Class TestCallMethodBuilder
 *
 * @method $this disabled(bool $disabled = true)
 * @method $this title(string $title)
 *
 * @package CodeSinging\PinAdmin\Tests\Viewless\Builder\Traits
 */
class TestCallPropertiesBuilder extends Builder
{
    protected $methods = [
        'disabled',
        'title',
    ];
}

/**
 * Class TestCallShortcutMethodBuilder
 *
 * @method $this sizeAsSmall()
 * @method $this sizeAsMini()
 *
 * @package CodeSinging\PinAdmin\Tests\Viewless\Builder\Traits
 */
class TestCallShortcutPropertiesBuilder extends Builder
{
    protected $shortcutMethods = [
        'size'
    ];
}

/**
 * Class TestCallEventBuild
 *
 * @method $this onClick(string $onClick = null, ...$parameters)
 * @method $this onChange(string $onChange = null, ...$parameters)
 * @method $this onSizeChange(string $onSizeChange = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Tests\Viewless\Builder\Traits
 */
class TestCallEventsBuilder extends Builder
{
    protected $baseTag = 'div';
    protected $events = [
        'click',
        'change',
        'sizeChange',
    ];
}

/**
 * Class testCallSlotsBuilder
 *
 * @method $this slotNamedPrefix($content, string $tag = 'template')
 * @method $this slotNamedEmpty($content, string $tag = 'template')
 *
 * @package CodeSinging\PinAdmin\Tests\Viewless\Builders
 */
class testCallSlotsBuilder extends Builder
{
    protected $slots = [
        'prefix',
        'empty',
    ];
}

class TestReadyBuilder extends Builder
{
    protected function ready(): void
    {
        $this->setBaseTag('span');
    }
}
