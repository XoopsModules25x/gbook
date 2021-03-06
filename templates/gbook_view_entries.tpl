<div id="gbook" class="gbook-view"><a href='sign.php'><{$signgbook}>&nbsp;&nbsp;<img src='./assets/images/sign.png' border='0' align='absmiddle'></a>
    <br>
    <br>
    <{$totalentries}>
    <br>
    <br>
    <{$pagenav}>

    <{foreach item=entry from=$entries}>
    <br>
    <hr>
    <br>

    <div id="gbook" class="gbook-title">
        <{$entry.date}>, <{$entry.name}>&nbsp;&nbsp;
        <{if $isadmin == 1}>
        <{if $entry.email != ""}><a href='mailto:<{$entry.email}>'><img src='./assets/images/email.png' border='0'/></a><{/if}>
        <{/if}>
        <{if $entry.url != ""}><a href='<{$entry.url}>' target="_blank"><img src='./assets/images/url.png' border='0'/></a><{/if}>
    </div>
    <div id="gbook" class="gbook-entry"><{$entry.message}></div>
    <{if $entry.note != ""}>
    <div id="gbook" class="gbook-note">-----------------------------<br><{$entry.note}></div>
    <{/if}>
    <{if $entry.admin != ""}><{$entry.admin}><{/if}>
    <{/foreach}>

    <br>
    <hr>
    <br>

    <{$pagenav}>

    <br>
</div>

