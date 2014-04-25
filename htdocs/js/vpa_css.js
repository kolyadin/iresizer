/**
* Copyright Xpoint.ru
**/
// �����-������, ����� ������� ������ �� �������� (��. ����)
function CssClassesHandler(object) { this.object = object }

CssClassesHandler.prototype = {
    object      : null,
    
    // ���������� ��� ������ �������� � ���� ������� �����
    all         : function() {
                    return this.object.className.split(/\s+/)
                },

    // �������� �� �������� ������ �����?
    exists      : function(className) {
                    var classes = this.all()
                    for(var i = 0; i < classes.length; i++)
                        if(classes[i] == className) return true
                    return false
                },

    // ��������� �������� �����
    add         : function(className) {
                    var classes = this.all()
                    for(var i = 0; i < classes.length; i++)
                        if(classes[i] == className) return
                    this.object.className = this.object.className + " " + className
                },

    // ������� ����� �� ����������� ��������
    remove      : function(className) {
                    var classes = this.all()
                    var cn = ""
                    for(var i = 0; i < classes.length; i++)
                        if(classes[i] != className) cn = cn + " " + classes[i]
                    this.object.className = cn.substr(1)
                },

    // ���������/������� ����� � ����������� �� ���������� ��������� state
    set         : function(className, state) {
                    if(state)
                        this.add(className)
                    else
                        this.remove(className)
                },

    // ��������� �������� �����, ���� �� ��� �� ��������, � ��������� ������ �������
    flip        : function(className) {
                    if(this.exists(className))
                        this.remove(className)
                    else
                        this.add(className)
                }
}

// �������, ��������� �����-������ ��� ������� ��������
function CssClasses(object) {
    return new CssClassesHandler(object)
}