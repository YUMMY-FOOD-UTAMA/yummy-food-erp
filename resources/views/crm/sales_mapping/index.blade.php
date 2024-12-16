@extends('layouts.app')
@push('css')
    <link href="https://kendo.cdn.telerik.com/themes/10.0.1/default/default-main.css" rel="stylesheet" />
@endpush
@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar heading-name="Sales Mapping">
            </x-toolbar>
        @endslot
            <div id="sample">
                <div id="myDiagramDiv" style="border: solid 1px black; height: 625px"></div>
                <div>
                    Edit details:<br>
                    <div id="myInspector"></div>
                </div>
                <p><button id="zoomToFit">Zoom to Fit</button> <button id="centerRoot">Center on root</button></p>
                <p>
                    This editable organizational chart sample color-codes the Nodes according to the tree level in
                    the hierarchy.
                </p>
                <p>
                    Select a node to edit its data values. This sample uses the
                    <a href="../samples/DataInspector.html">Data Inspector</a> extension to display and modify Part
                    data. Because this simple app is part of a static web site, there is no way to upload a
                    photograph for a person.
                </p>
                <p>
                    Double click in the diagram background to add a new boss. That uses the
                    <a>ClickCreatingTool</a> with a custom <a>ClickCreatingTool.insertPart</a> to scroll to the new
                    node and start editing the <a>TextBlock</a> for its name .
                </p>
                <p>
                    Drag a node onto another in order to change relationships, if permitted. Right-click or tap-hold
                    a Node to bring up a context menu that allows you to:
                </p>

                <ul>
                    <li>Add Employee - add a new person as a direct report to this person</li>
                    <li>Vacate Position - remove the information specific to the current person in that role</li>
                    <li>
                        Remove Role - removes the person entirely and changes the direct reports to report to the
                        (former) boss
                    </li>
                    <li>Remove Department - removes the person and whole subtree</li>
                </ul>
                <p>
                    To learn how to build an org chart from scratch with GoJS, see the
                    <a href="../learn/index.html">Getting Started tutorial</a>.
                </p>
                <p>This sample is set to the dark theme by default.</p>
                <p>
                    If you want to have some "assistant" nodes on the side, above the regular reports, see the
                    <a href="orgChartAssistants.html">Org Chart Assistants</a> sample, which is a more simply styled
                    version of this sample that uses a custom <a>TreeLayout</a> to position "assistants" that way.
                </p>
                <div>
                    <div>
                        <button id="SaveButton" onclick="save()">Save</button>
                        <button onclick="load()">Load</button>
                        Diagram Model saved in JSON format:
                    </div>
                    <textarea id="mySavedModel" style="width: 100%; height: 270px">{ "class": "go.TreeModel",
  "nodeDataArray": [
{"key":1, "name":"Stella Payne Diaz", "title":"CEO", "dept": "Management", "pic":"1.jpg", "email": "sdiaz@example.com", "phone": "(234) 555-6789" },
{"key":2, "name":"Luke Warm", "title":"VP Marketing/Sales", "dept": "Management", "pic":"2.jpg", "email": "lwarm@example.com", "phone": "(234) 555-6789", "parent":1},
{"key":3, "name":"Meg Meehan Hoffa", "title":"Sales", "dept": "Sales", "pic":"3.jpg", "email": "mhoffa@example.com", "phone": "(234) 555-6789", "parent":2},
{"key":4, "name":"Peggy Flaming", "title":"VP Engineering", "dept": "Management", "pic":"4.jpg", "email": "pflaming@example.com", "phone": "(234) 555-6789", "parent":1},
{"key":5, "name":"Saul Wellingood", "title":"Manufacturing", "dept": "Production", "pic":"5.jpg", "email": "swellingood@example.com", "phone": "(234) 555-6789", "parent":4},
{"key":6, "name":"Al Ligori", "title":"Marketing", "dept": "Marketing", "pic":"6.jpg", "email": "aligori@example.com", "phone": "(234) 555-6789", "parent":2},
{"key":7, "name":"Dot Stubadd", "title":"Sales Rep", "dept": "Sales", "pic":"7.jpg", "email": "dstubadd@example.com", "phone": "(234) 555-6789", "parent":3},
{"key":8, "name":"Les Ismore", "title":"Project Mgr", "dept": "Production", "pic":"8.jpg", "email": "lismore@example.com", "phone": "(234) 555-6789", "parent":5},
{"key":9, "name":"April Lynn Parris", "title":"Events Mgr", "dept": "Marketing", "pic":"9.jpg", "email": "aparris@example.com", "phone": "(234) 555-6789", "parent":6},
{"key":10, "name":"Xavier Breath", "title":"Engineering", "dept": "Engineering", "pic":"10.jpg", "email": "xbreath@example.com", "phone": "(234) 555-6789", "parent":4},
{"key":11, "name":"Anita Hammer", "title":"Process", "dept": "Production", "pic":"11.jpg", "email": "ahammer@example.com", "phone": "(234) 555-6789", "parent":5},
{"key":12, "name":"Billy Aiken", "title":"Software", "dept": "Engineering", "pic":"12.jpg", "email": "baiken@example.com", "phone": "(234) 555-6789", "parent":10},
{"key":13, "name":"Stan Wellback", "title":"Testing", "dept": "Engineering", "pic":"13.jpg", "email": "swellback@example.com", "phone": "(234) 555-6789", "parent":10},
{"key":14, "name":"Marge Innovera", "title":"Hardware", "dept": "Engineering", "pic":"14.jpg", "email": "minnovera@example.com", "phone": "(234) 555-6789", "parent":10},
{"key":15, "name":"Evan Elpus", "title":"Quality", "dept": "Production", "pic":"15.jpg", "email": "eelpus@example.com", "phone": "(234) 555-6789", "parent":5},
{"key":16, "name":"Lotta B. Essen", "title":"Sales Rep", "dept": "Sales", "pic":"16.jpg", "email": "lessen@example.com", "phone": "(234) 555-6789", "parent":3}
 ]
}
    </textarea>
                </div>
                <dialog>
                    <div style="display: flex; flex-direction: column">
                        <p></p>
                        <p>Click anywhere to close</p>
                    </div>
                </dialog>
                <p id="hidden">this forces the font to load in Chromium browsers</p>
            </div>


    </x-general-section-content>

@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/gojs@3.0.16/release/go.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/create-gojs-kit@3.0.16/dist/extensions/DataInspector.js"></script>
    <script id="code">
        function init() {
            myDiagram = new go.Diagram('myDiagramDiv', {
                allowCopy: false,
                allowDelete: false,
                initialAutoScale: go.AutoScale.UniformToFill,
                maxSelectionCount: 1, // users can select only one part at a time
                validCycle: go.CycleMode.DestinationTree, // make sure users can only create trees
                'clickCreatingTool.archetypeNodeData': {
                    // allow double-click in background to create a new node
                    name: '(New person)',
                    title: '(Title)',
                    dept: '(Dept)'
                },
                'clickCreatingTool.insertPart': function (loc) {
                    // method override must be function, not =>
                    const node = go.ClickCreatingTool.prototype.insertPart.call(this, loc);
                    if (node !== null) {
                        this.diagram.select(node);
                        this.diagram.commandHandler.scrollToPart(node);
                        this.diagram.commandHandler.editTextBlock(node.findObject('NAMETB'));
                    }
                    return node;
                },
                layout: new go.TreeLayout({
                    treeStyle: go.TreeStyle.LastParents,
                    arrangement: go.TreeArrangement.Horizontal,
                    // properties for most of the tree:
                    angle: 90,
                    layerSpacing: 35,
                    // properties for the "last parents":
                    alternateAngle: 90,
                    alternateLayerSpacing: 35,
                    alternateAlignment: go.TreeAlignment.Bus,
                    alternateNodeSpacing: 20
                }),
                'undoManager.isEnabled': true, // enable undo & redo
                'themeManager.changesDivBackground': true,
                'themeManager.currentTheme': 'dark'
            });

            // when the document is modified, add a "*" to the title and enable the "Save" button
            myDiagram.addDiagramListener('Modified', (e) => {
                const button = document.getElementById('SaveButton');
                if (button) button.disabled = !myDiagram.isModified;
                const idx = document.title.indexOf('*');
                if (myDiagram.isModified) {
                    if (idx < 0) document.title += '*';
                } else {
                    if (idx >= 0) document.title = document.title.slice(0, idx);
                }
            });

            // set up some colors/fonts for the default ('light') and dark Themes
            myDiagram.themeManager.set('light', {
                colors: {
                    background: '#fff',
                    text: '#111827',
                    textHighlight: '#11a8cd',
                    subtext: '#6b7280',
                    badge: '#f0fdf4',
                    badgeBorder: '#16a34a33',
                    badgeText: '#15803d',
                    divider: '#6b7280',
                    shadow: '#9ca3af',
                    tooltip: '#1f2937',
                    levels: [
                        '#AC193D',
                        '#2672EC',
                        '#8C0095',
                        '#5133AB',
                        '#008299',
                        '#D24726',
                        '#008A00',
                        '#094AB2'
                    ],
                    dragOver: '#f0f9ff',
                    link: '#9ca3af',
                    div: '#f3f4f6'
                },
                fonts: {
                    name: '500 0.875rem InterVariable, sans-serif',
                    normal: '0.875rem InterVariable, sans-serif',
                    badge: '500 0.75rem InterVariable, sans-serif',
                    link: '600 0.875rem InterVariable, sans-serif'
                }
            });

            myDiagram.themeManager.set('dark', {
                colors: {
                    background: '#111827',
                    text: '#fff',
                    subtext: '#d1d5db',
                    badge: '#22c55e19',
                    badgeBorder: '#22c55e21',
                    badgeText: '#4ade80',
                    shadow: '#111827',
                    dragOver: '#082f49',
                    link: '#6b7280',
                    div: '#1f2937'
                }
            });

            // this is used to determine feedback during drags
            function mayWorkFor(node1, node2) {
                if (!(node1 instanceof go.Node)) return false; // must be a Node
                if (node1 === node2) return false; // cannot work for yourself
                if (node2.isInTreeOf(node1)) return false; // cannot work for someone who works for you
                return true;
            }

            // This converter is used by the Picture.
            function findHeadShot(pic) {
                if (!pic) return '../samples/images/user.svg'; // There are only 16 images on the server
                return '../samples/images/HS' + pic;
            }

            // Used to convert the node's tree level into a theme color
            function findLevelColor(node) {
                return node.findTreeLevel();
            }

            // Gets the text for a tooltip based on the adorned object's name
            function toolTipTextConverter(obj) {
                if (obj.name === 'EMAIL') return obj.part.data.email;
                if (obj.name === 'PHONE') return obj.part.data.phone;
            }

            // Align the tooltip based on the adorned object's viewport bounds
            function toolTipAlignConverter(obj, tt) {
                const d = obj.diagram;
                const bot = obj.getDocumentPoint(go.Spot.Bottom);
                const viewPt = d.transformDocToView(bot).offset(0, 35);
                // if tooltip would be below viewport, show above instead
                const align =
                    d.viewportBounds.height >= viewPt.y / d.scale
                        ? new go.Spot(0.5, 1, 0, 6)
                        : new go.Spot(0.5, 0, 0, -6);

                tt.alignment = align;
                tt.alignmentFocus = align.y === 1 ? go.Spot.Top : go.Spot.Bottom;
            }

            // a tooltip for the Email and Phone buttons
            const toolTip = new go.Adornment(go.Panel.Spot, {
                isShadowed: true,
                shadowOffset: new go.Point(0, 2)
            })
                .add(
                    new go.Placeholder(),
                    new go.Panel(go.Panel.Auto)
                        .add(
                            new go.Shape('RoundedRectangle', { strokeWidth: 0, shadowVisible: true }).theme('fill', 'background'),
                            new go.TextBlock({ margin: 2 })
                                .bindObject('text', 'adornedObject', toolTipTextConverter)
                                .theme('stroke', 'text')
                                .theme('font', 'normal')
                        )
                        // sets alignment and alignmentFocus based on adorned object's position in viewport
                        .bindObject('', 'adornedObject', toolTipAlignConverter)
                )
                .theme('shadowColor', 'shadow');

            // define the Node template
            myDiagram.nodeTemplate = new go.Node(go.Panel.Spot, {
                isShadowed: true,
                shadowOffset: new go.Point(0, 2),
                selectionObjectName: 'BODY',
                // show/hide buttons when mouse enters/leaves
                mouseEnter: (e, node) =>
                    (node.findObject('BUTTON').opacity = node.findObject('BUTTONX').opacity = 1),
                mouseLeave: (e, node) => {
                    if (node.isSelected) return; // if selected dont hide buttons
                    node.findObject('BUTTON').opacity = node.findObject('BUTTONX').opacity = 0;
                },
                // handle dragging a Node onto a Node to (maybe) change the reporting relationship
                mouseDragEnter: (e, node, prev) => {
                    const diagram = node.diagram;
                    const selnode = diagram.selection.first();
                    if (!mayWorkFor(selnode, node)) return;
                    const shape = node.findObject('SHAPE');
                    if (shape) {
                        shape._prevFill = shape.fill; // remember the original brush
                        shape.fill = diagram.themeManager.findValue('dragOver', 'colors'); // "#e0f2fe";
                    }
                },
                mouseDragLeave: (e, node, next) => {
                    const shape = node.findObject('SHAPE');
                    if (shape && shape._prevFill) {
                        shape.fill = shape._prevFill; // restore the original brush
                    }
                },
                mouseDrop: (e, node) => {
                    const diagram = node.diagram;
                    const selnode = diagram.selection.first(); // assume just one Node in selection
                    if (mayWorkFor(selnode, node)) {
                        // find any existing link into the selected node
                        const link = selnode.findTreeParentLink();
                        if (link !== null) {
                            // reconnect any existing link
                            link.fromNode = node;
                        } else {
                            // else create a new link
                            diagram.toolManager.linkingTool.insertLink(node, node.port, selnode, selnode.port);
                        }
                    }
                }
            })
                .add(
                    new go.Panel(go.Panel.Auto, { name: 'BODY' })
                        .add(
                            // define the node's outer shape
                            new go.Shape('RoundedRectangle', {
                                name: 'SHAPE',
                                strokeWidth: 0,
                                portId: '',
                                spot1: go.Spot.TopLeft,
                                spot2: go.Spot.BottomRight
                            }).theme('fill', 'background'),
                            new go.Panel(go.Panel.Table, { margin: 0.5, defaultRowSeparatorStrokeWidth: 0.5 })
                                .theme('defaultRowSeparatorStroke', 'divider')
                                .add(
                                    new go.Panel(go.Panel.Table, { padding: new go.Margin(18, 18, 18, 24) })
                                        .addColumnDefinition(0, { width: 240 })
                                        .add(
                                            new go.Panel(go.Panel.Table, {
                                                column: 0,
                                                alignment: go.Spot.Left,
                                                stretch: go.Stretch.Vertical,
                                                defaultAlignment: go.Spot.Left
                                            })
                                                .add(
                                                    new go.Panel(go.Panel.Horizontal, { row: 0 })
                                                        .add(
                                                            new go.TextBlock({ editable: true, minSize: new go.Size(10, 14) })
                                                                .bindTwoWay('text', 'name')
                                                                .theme('stroke', 'text')
                                                                .theme('font', 'name'),
                                                            new go.Panel(go.Panel.Auto, { margin: new go.Margin(0, 0, 0, 10) })
                                                                .add(
                                                                    new go.Shape('Capsule', { parameter1: 6, parameter2: 6 })
                                                                        .theme('fill', 'badge')
                                                                        .theme('stroke', 'badgeBorder'),
                                                                    new go.TextBlock({
                                                                        editable: true,
                                                                        minSize: new go.Size(10, 12),
                                                                        margin: new go.Margin(2, -1)
                                                                    })
                                                                        .bindTwoWay('text', 'dept')
                                                                        .theme('stroke', 'badgeText')
                                                                        .theme('font', 'badge')
                                                                )
                                                        ),
                                                    new go.TextBlock({ row: 1, editable: true, minSize: new go.Size(10, 14) })
                                                        .bindTwoWay('text', 'title')
                                                        .theme('stroke', 'subtext')
                                                        .theme('font', 'normal')
                                                ),
                                            new go.Panel(go.Panel.Spot, { isClipping: true, column: 1 })
                                                .add(
                                                    new go.Shape('Circle', { desiredSize: new go.Size(50, 50), strokeWidth: 0 }),
                                                    new go.Picture({
                                                        name: 'PICTURE',
                                                        source: '../samples/images/user.svg',
                                                        desiredSize: new go.Size(50, 50)
                                                    }).bind('source', 'pic', findHeadShot)
                                                )
                                        ),
                                    new go.Panel(go.Panel.Table, {
                                        row: 1,
                                        stretch: go.Stretch.Horizontal,
                                        defaultColumnSeparatorStrokeWidth: 0.5
                                    })
                                        .theme('defaultColumnSeparatorStroke', 'divider')
                                        .add(makeBottomButton('EMAIL'), makeBottomButton('PHONE'))
                                )
                        ), // end Auto Panel
                    new go.Shape('RoundedLeftRectangle', {
                        alignment: go.Spot.Left,
                        alignmentFocus: go.Spot.Left,
                        stretch: go.Stretch.Vertical,
                        width: 6,
                        strokeWidth: 0
                    }).themeObject('fill', '', 'levels', findLevelColor),
                    go.GraphObject.build('Button', {
                        name: 'BUTTON',
                        alignment: go.Spot.Right,
                        opacity: 0, // initially not visible
                        click: (e, button) => addEmployee(button.part)
                    })
                        // button is visible either when node is selected or on mouse-over
                        .bindObject('opacity', 'isSelected', (s) => (s ? 1 : 0))
                        .add(
                            new go.Shape('PlusLine', { width: 8, height: 8, stroke: '#0a0a0a', strokeWidth: 2 })
                        ),
                    go.GraphObject.build('TreeExpanderButton', {
                        _treeExpandedFigure: 'LineUp',
                        _treeCollapsedFigure: 'LineDown',
                        name: 'BUTTONX',
                        alignment: go.Spot.Bottom,
                        opacity: 0 // initially not visible
                    })
                        // button is visible either when node is selected or on mouse-over
                        .bindObject('opacity', 'isSelected', (s) => (s ? 1 : 0))
                )
                .theme('shadowColor', 'shadow')
                // for sorting, have the Node.text be the data.name
                .bind('text', 'name')
                // bind the Part.layerName to control the Node's layer depending on whether it isSelected
                .bindObject('layerName', 'isSelected', (sel) => (sel ? 'Foreground' : ''))
                .bindTwoWay('isTreeExpanded');

            function makeBottomButton(name) {
                const phonePath =
                    'F M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z';
                const emailPath =
                    'F M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3zM19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z';
                const convertSelectedToThemeProp = (s) => (s ? 'textHighlight' : 'text');
                const isEmail = name === 'EMAIL';
                return new go.Panel(go.Panel.Table, {
                    mouseEnter: (e, obj) => myDiagram.model.set(obj.part.data, name, true),
                    mouseLeave: (e, obj) => myDiagram.model.set(obj.part.data, name, false),
                    name,
                    background: 'transparent',
                    cursor: 'Pointer',
                    column: isEmail ? 0 : 1,
                    width: 140,
                    height: 40,
                    toolTip: toolTip,
                    click: (e, obj) => {
                        dialog.firstElementChild.firstElementChild.innerHTML =
                            // the modal's span
                            `You clicked to ${isEmail ? 'send email to' : 'call'} ${obj.part.data.name} at ${obj.part.data[name.toLowerCase()]}`;
                        dialog.showModal();
                    }
                })
                    .add(
                        new go.Panel(go.Panel.Horizontal)
                            .add(
                                new go.Shape({
                                    geometryString: isEmail ? emailPath : phonePath,
                                    strokeWidth: 0,
                                    desiredSize: isEmail ? new go.Size(20, 16) : new go.Size(20, 20),
                                    margin: new go.Margin(0, 12, 0, 0)
                                })
                                    .theme('fill', 'text')
                                    .themeData('fill', name, null, convertSelectedToThemeProp),
                                new go.TextBlock(isEmail ? 'Email' : 'Phone')
                                    .theme('stroke', 'text')
                                    .themeData('stroke', name, null, convertSelectedToThemeProp)
                                    .theme('font', 'link')
                            )
                    );
            }

            function addEmployee(node) {
                if (!node) return;
                const thisemp = node.data;
                let newnode;
                myDiagram.model.commit((m) => {
                    const newemp = {
                        name: '(New person)',
                        title: '(Title)',
                        dept: thisemp.dept,
                        parent: thisemp.key
                    };
                    m.addNodeData(newemp);
                    newnode = myDiagram.findNodeForData(newemp);
                    // set location so new node doesn't animate in from top left
                    if (newnode) newnode.location = node.location;
                }, 'add employee');
                myDiagram.commandHandler.scrollToPart(newnode);
            }

            // the context menu allows users to make a position vacant,
            // remove a role and reassign the subtree, or remove a department
            myDiagram.nodeTemplate.contextMenu = go.GraphObject.build('ContextMenu')
                .add(
                    go.GraphObject.build('ContextMenuButton', {
                        click: (e, button) => addEmployee(button.part.adornedPart)
                    }).add(new go.TextBlock('Add Employee')),
                    go.GraphObject.build('ContextMenuButton', {
                        click: (e, button) => {
                            const node = button.part.adornedPart;
                            if (node !== null) {
                                const thisemp = node.data;
                                myDiagram.model.commit((m) => {
                                    // update the name, picture, email, and phone, but leave the title/department
                                    m.set(thisemp, 'name', '(Vacant)');
                                    m.set(thisemp, 'pic', '');
                                    m.set(thisemp, 'email', 'none');
                                    m.set(thisemp, 'phone', 'none');
                                }, 'vacate');
                            }
                        }
                    }).add(new go.TextBlock('Vacate Position')),
                    go.GraphObject.build('ContextMenuButton', {
                        click: (e, button) => {
                            // reparent the subtree to this node's boss, then remove the node
                            const node = button.part.adornedPart;
                            if (node !== null) {
                                myDiagram.model.commit((m) => {
                                    const chl = node.findTreeChildrenNodes();
                                    // iterate through the children and set their parent key to our selected node's parent key
                                    while (chl.next()) {
                                        const emp = chl.value;
                                        m.setParentKeyForNodeData(emp.data, node.findTreeParentNode().data.key);
                                    }
                                    // and now remove the selected node itself
                                    m.removeNodeData(node.data);
                                }, 'reparent remove');
                            }
                        }
                    }).add(new go.TextBlock('Remove Role')),
                    go.GraphObject.build('ContextMenuButton', {
                        click: (e, button) => {
                            // remove the whole subtree, including the node itself
                            const node = button.part.adornedPart;
                            if (node !== null) {
                                myDiagram.commit((d) => d.removeParts(node.findTreeParts()), 'remove dept');
                            }
                        }
                    }).add(new go.TextBlock('Remove Department'))
                );

            // define the Link template
            myDiagram.linkTemplate = new go.Link({
                routing: go.Routing.Orthogonal,
                layerName: 'Background',
                corner: 5
            }).add(new go.Shape({ strokeWidth: 2 }).theme('stroke', 'link')); // the link shape

            // read in the JSON-format data from the "mySavedModel" element
            load();

            // support editing the properties of the selected person in HTML
            myInspector = new Inspector('myInspector', myDiagram, {
                properties: {
                    key: { readOnly: true },
                    // Don't show these temporary data values
                    EMAIL: { show: false },
                    PHONE: { show: false }
                }
            });

            // Setup zoom to fit button
            document
                .getElementById('zoomToFit')
                .addEventListener('click', () => myDiagram.commandHandler.zoomToFit());

            document.getElementById('centerRoot').addEventListener('click', () => {
                myDiagram.scale = 1;
                myDiagram.commandHandler.scrollToPart(myDiagram.findNodeForKey(1));
            });
        } // end init

        // Show the diagram's model in JSON format
        function save() {
            document.getElementById('mySavedModel').value = myDiagram.model.toJson();
            myDiagram.isModified = false;
        }
        function load() {
            myDiagram.model = go.Model.fromJson(document.getElementById('mySavedModel').value);
            // make sure new data keys are unique positive integers
            let lastkey = 1;
            myDiagram.model.makeUniqueKeyFunction = (model, data) => {
                let k = data.key || lastkey;
                while (model.findNodeDataForKey(k)) k++;
                data.key = lastkey = k;
                return k;
            };
        }

        window.addEventListener('DOMContentLoaded', () => {
            dialog = document.querySelector('dialog');
            dialog.addEventListener('click', (e) => {
                dialog.close();
            });
            // setTimeout only to ensure font is loaded before loading diagram
            // you may want to use an asset loading library for this
            // to keep this sample simple, it does not
            setTimeout(() => {
                init();
            }, 300);
        });
    </script>
@endpush
