/**
* Copyright Xpoint.ru
**/
// �����-������, ����� ������� ������ �� �������� (��. ����)
function ObjEventsHandler() { this.object = window.storage.obj_events; }

ObjEventsHandler.prototype = {
    object      : '',
    
    // ���������� ��� ������ �������� � ���� ������� �����
    all         : function() {
                    return window.storage.obj_events.split(/\s+/)
                },

    // �������� �� �������� ������ �����?
    exists      : function(obj_event) {
                    var events = this.all()
                    for(var i = 0; i < events.length; i++)
                        if(events[i] == obj_event) return true
                    return false
                },

    // ��������� �������� �����
    add         : function(obj_event) {
                    var events = this.all()
                    for(var i = 0; i < events.length; i++)
                        if(events[i] == obj_event) return
                    window.storage.obj_events = window.storage.obj_events + " " + obj_event
                },

    // ������� ����� �� ����������� ��������
    remove      : function(obj_event) {
                    var events = this.all()
                    var cn = ""
                    for(var i = 0; i < events.length; i++)
                        if(events[i] != obj_event) cn = cn + " " + events[i]
                    window.storage.obj_events = cn.substr(1)
                },

    // ���������/������� ����� � ����������� �� ���������� ��������� state
    set         : function(obj_event, state) {
                    if(state)
                        this.add(obj_event)
                    else
                        this.remove(obj_event)
                },

    // ��������� �������� �����, ���� �� ��� �� ��������, � ��������� ������ �������
    flip        : function(obj_event) {
                    if(this.exists(obj_event))
                        this.remove(obj_event)
                    else
                        this.add(obj_event)
                },
                
    toString    : function() {
                    return 'vpa_obj_events';
                }
}

// �������, ��������� �����-������ ��� ������� ��������
function ObjEvents() {
    return new ObjEventsHandler()
}