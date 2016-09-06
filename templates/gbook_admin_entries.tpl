<table>
    <tr>
        <th><{$smarty.const._AM_GBOOK_NAME}></th>
        <th><{$smarty.const._AM_GBOOK_MESSAGE}></th>
        <th><{$smarty.const._AM_GBOOK_ACTION}></th>
    </tr>
    <{foreach item=entry from=$entries}>
    <tr class="<{cycle values='odd, even'}>">
        <td><{$entry.name}></td>
        <td><{$entry.message}></td>
        <td align="center" width=50px>
            <a href="entries.php?id=<{$entry.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"/></a>
            &nbsp;<a href="entries.php?op=delete&amp;id=<{$entry.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
        </td>
    </tr>
    <{/foreach}>
</table>
