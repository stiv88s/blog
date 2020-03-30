    var Ziggy = {
        namedRoutes: {"attachments.download-shared":{"uri":"attachments\/shared\/{token}","methods":["GET","HEAD"],"domain":null},"attachments.download":{"uri":"attachments\/{id}\/{name}","methods":["GET","HEAD"],"domain":null},"attachments.dropzone":{"uri":"attachments\/dropzone","methods":["POST"],"domain":null},"attachments.dropzone.delete":{"uri":"attachments\/dropzone\/{id}","methods":["DELETE"],"domain":null},"showing.post":{"uri":"post\/{post}-{slug}","methods":["GET","HEAD"],"domain":null},"store.comment":{"uri":"post{post}\/comment","methods":["POST"],"domain":null},"like.post":{"uri":"post\/{post}\/like","methods":["POST"],"domain":null},"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"logout":{"uri":"logout","methods":["POST"],"domain":null},"register":{"uri":"register","methods":["GET","HEAD"],"domain":null},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"],"domain":null},"password.email":{"uri":"password\/email","methods":["POST"],"domain":null},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"],"domain":null},"password.update":{"uri":"password\/reset","methods":["POST"],"domain":null},"password.confirm":{"uri":"password\/confirm","methods":["GET","HEAD"],"domain":null},"home":{"uri":"admin\/home","methods":["GET","HEAD"],"domain":null},"post.index":{"uri":"admin\/post","methods":["GET","HEAD"],"domain":null},"post.create":{"uri":"admin\/post\/create","methods":["GET","HEAD"],"domain":null},"post.store":{"uri":"admin\/post","methods":["POST"],"domain":null},"post.show":{"uri":"admin\/post\/{post}","methods":["GET","HEAD"],"domain":null},"post.edit":{"uri":"admin\/post\/{post}\/edit","methods":["GET","HEAD"],"domain":null},"post.update":{"uri":"admin\/post\/{post}","methods":["PUT","PATCH"],"domain":null},"post.destroy":{"uri":"admin\/post\/{post}","methods":["DELETE"],"domain":null},"category.index":{"uri":"admin\/category","methods":["GET","HEAD"],"domain":null},"category.create":{"uri":"admin\/category\/create","methods":["GET","HEAD"],"domain":null},"category.store":{"uri":"admin\/category","methods":["POST"],"domain":null},"category.show":{"uri":"admin\/category\/{category}","methods":["GET","HEAD"],"domain":null},"category.edit":{"uri":"admin\/category\/{category}\/edit","methods":["GET","HEAD"],"domain":null},"category.update":{"uri":"admin\/category\/{category}","methods":["PUT","PATCH"],"domain":null},"category.destroy":{"uri":"admin\/category\/{category}","methods":["DELETE"],"domain":null},"tag.index":{"uri":"admin\/tag","methods":["GET","HEAD"],"domain":null},"tag.create":{"uri":"admin\/tag\/create","methods":["GET","HEAD"],"domain":null},"tag.store":{"uri":"admin\/tag","methods":["POST"],"domain":null},"tag.show":{"uri":"admin\/tag\/{tag}","methods":["GET","HEAD"],"domain":null},"tag.edit":{"uri":"admin\/tag\/{tag}\/edit","methods":["GET","HEAD"],"domain":null},"tag.update":{"uri":"admin\/tag\/{tag}","methods":["PUT","PATCH"],"domain":null},"tag.destroy":{"uri":"admin\/tag\/{tag}","methods":["DELETE"],"domain":null},"user.index":{"uri":"admin\/user","methods":["GET","HEAD"],"domain":null},"user.create":{"uri":"admin\/user\/create","methods":["GET","HEAD"],"domain":null},"user.store":{"uri":"admin\/user","methods":["POST"],"domain":null},"user.show":{"uri":"admin\/user\/{user}","methods":["GET","HEAD"],"domain":null},"user.edit":{"uri":"admin\/user\/{user}\/edit","methods":["GET","HEAD"],"domain":null},"user.update":{"uri":"admin\/user\/{user}","methods":["PUT","PATCH"],"domain":null},"user.destroy":{"uri":"admin\/user\/{user}","methods":["DELETE"],"domain":null}},
        baseUrl: 'http://localhost/',
        baseProtocol: 'http',
        baseDomain: 'localhost',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
