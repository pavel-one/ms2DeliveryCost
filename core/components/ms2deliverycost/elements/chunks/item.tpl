{*$costs | print*}
{*$order | print*}
{foreach $costs as $delivery index=$index}
    {var $checked = !$order.delivery && $index == 0 || $delivery.delivery.id == $order.delivery}
    <div class="checkbox">
        <label class="delivery input-parent">
            <input type="radio" name="delivery" value="{$delivery.delivery.id}" id="delivery_{$delivery.delivery.id}"
                   data-payments="{$delivery.payments | json_encode}"
                    {$checked ? 'checked' : ''}>
            {if $delivery.delivery.logo?}
                <img src="{$delivery.delivery.logo}" alt="{$delivery.delivery.name}" title="{$delivery.delivery.name}"/>
                <span>{$delivery.delivery.name}</span>
            {else}
                {$delivery.delivery.name}
            {/if}
            {if $delivery.delivery.description?}
                <p class="small">
                    {$delivery.delivery.description}
                </p>
            {/if}
            {if $delivery.cost !== false}
                {*если расчет был запущен*}
                {if $delivery.cost !== 0}
                    <p class="small">
                        Стоимость доставки составит: {$delivery.cost} руб.
                    </p>
                {else}
                    {*если цена доставки равняется нулю*}
                    <p class="small" style="color: red">
                        Доставка либо не осуществляется, либо равна нулю
                    </p>
                {/if}
            {else}
                {*вывод без запуска расчетов*}
            {/if}
        </label>
    </div>
{/foreach}
