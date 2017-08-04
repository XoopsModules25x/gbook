<div id="gbook" class="gbook-view">
    <a href='index.php'><{$lang_back}></a><br><br>
</div>
<{if $lang_desc}>
<div id="gbook" class="gbook-view"><{$lang_desc}></div>
<br class='clear'>
<{/if}>
<{if $stop}>
<div class="errorMsg txtleft"><{$stop}></div>
<{/if}>
<div id="gbook" class="gbook-sign">
    <{$gbookform.javascript}>
    <form name="<{$gbookform.name}>" action="<{$gbookform.action}>" method="<{$gbookform.method}>"
    <{$gbookform.extra}>>
    <table class="outer" cellspacing="1">
        <!-- start of form elements loop -->
        <{foreach item=element from=$gbookform.elements}>
        <{if $element.hidden != true}>
        <tr>
            <td class="head">
                <div class="xoops-form-element-caption<{if $element.required}>-required<{/if}>"><span class="caption-text"><{$element.caption}></span><span class="caption-marker">&nbsp;*</span></div>
            </td>
            <td class="<{cycle values=" even,odd"}>"><{$element.body}></td>
        </tr>
        <{else}>
        <{$element.body}>
        <{/if}>
        <{/foreach}>
        <!-- end of form elements loop -->
    </table>
    </form>
</div>
