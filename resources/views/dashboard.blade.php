@extends('home')

@section('dashboard-content')
    <div id="dashboard-cont">

    </div>
    
    <script type="text/babel">
    
        class Dashboard extends React.Component{
    
            constructor(props){
                super(props)
                this.state={
                    widgets:[],
                    startDate:"",
                    endDate:"",
                    widgetName:"",
                    widgetSort:"",
                    widgetWidth:"",
                    widgetId:""
                }
                
            }
    
            componentDidMount(){
                axios.get("http://accounts.me/api/widgets")
                .then(res=>{
                    this.setState({
                        widgets:res.data
                    })
                    console.log(this.state.widgets)
                })
                .catch(e=>{
                    console.log(e)
                })
            }
            setWidgetValues=(data)=>{
                this.setState({
                    widgetName:data.widget_name,
                    widgetSort:data.sort,
                    widgetWidth:data.width,
                    widgetId:data.id
                })
            }
            saveWidget=()=>{
                axios.put("http://accounts.me/api/widgets",{
                    widgetName:this.state.widgetName,
                    widgetSort:this.state.widgetSort,
                    widgetWidth:this.state.widgetWidth,
                    widgetId:this.state.widgetId,
                })
                .then(res=>{
                    this.state.widgets.map(wid=>{
                        if(wid.id==this.state.widgetId){
                            wid.widget_name=this.state.widgetName
                            wid.width=this.state.widgetWidth
                            wid.sort=this.state.widgetSort
                        }
                    })
                    console.log(res)
                })
                .catch(e=>{
                    console.log(e)
                })
                //save widget locally
            }

            sortByDate=(e)=>{
                axios.get("http://accounts.me/api/widgets?startDate="+this.state.startDate+"&endDate="+this.state.endDate)
                .then(res=>{
                    this.setState({
                        widgets:res.data
                    })
                    console.log(res)
                })
                .catch(e=>{
                    console.log(e)
                })
            }
    
            render(){
                
                const items=this.state.widgets.map(wid=>{
    
                    let icon_for_the_item=""
                    let dashboard_item_color=""
                    var order={ order : wid.sort}
                    if (wid.type=="Total Expenses") {
                            icon_for_the_item=<span className="oi oi-cart"></span>
                            dashboard_item_color="dashboard-item-color-red"
                    }
                    else if(wid.type=="Total Profit"){
                            icon_for_the_item=<span className="oi oi-dollar"></span>
                            dashboard_item_color="dashboard-item-color-green"
                    }
                    else if(wid.type=="Total Income"){
                            icon_for_the_item=<span className="oi oi-dollar"></span>
                            dashboard_item_color="dashboard-item-color-blue"
                    }
      
                    if (wid.type=="Total Expenses"
                        || wid.type=="Total Profit" || wid.type=="Total Income") {
                            
                        return(
                                <div style={order}  className={"dashboard-item dashboard-item-total "+ dashboard_item_color +(wid.width==100? " width-full":" ")+(wid.width==20? " width-twenty":" ")+(wid.width==35? " width-thirty":" ") }  key={wid.id}>
                                    <div className="dropdown">
                                        <span className="oi oi-menu " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                        <div className="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <button onClick={()=>{this.setWidgetValues(wid)}} type="button"  data-toggle="modal" data-target="#exampleModal" className="dropdown-item">EDIT</button>
                                            <button className="dropdown-item" href="#">DELETE</button>
                                        </div>
                                    </div>
                                    <div>
                                        <div className="widget-item-header">
                                            <p>{wid.widget_name}</p>
                                            <p>${wid.total==null?0:wid.total}</p>
                                        </div>
                                        <div className="widget-item-icon">
                                            {icon_for_the_item}
                                        </div>    
                                    </div>
                                    
                                    <div className="modal fade" id="exampleModal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div className="modal-dialog" role="document">
                                            <div className="modal-content">
                                            <div className="modal-header">
                                                <h5 className="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div className="modal-body">
                                                <input onChange={(e)=>{this.setState({widgetName:e.target.value})}} type="text" name="widget_name" value={wid.widget_name} />
                                                <input onChange={(e)=>{this.setState({widgetSort:e.target.value})}} type="text" name="widget_sort" value={wid.sort} />
                                                <input onChange={(e)=>{this.setState({widgetWidth:e.target.value})}} type="text" name="widget_width" value={wid.width} />
                                            </div>
                                            <div className="modal-footer">
                                                <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button onClick={this.saveWidget} type="button" className="btn btn-primary">Save changes</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            )
                    } 
                    else {
                                // wil have tables with differenct columns
                                let table=""
                                if (wid.type=="Account Balance") {
                                    table=<table className="table">
                                                <thead className="thead-light">
                                                    <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {wid.accounts.map(acc=>{
                                                        return(
                                                            <tr key={acc.id}>
                                                                <td>{acc.acc_name}</td>
                                                                <td>${acc.total==null?0:acc.total}</td>
                                                            </tr>
                                                        )
                                                    })
                                                    }
                                                </tbody>
                                            </table>
                                } 
                                else if(wid.type=="Latest Income"){
                                    table=<table className="table">
                                                <thead className="thead-light">
                                                    <tr>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Payment Method</th>
                                                    <th scope="col">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {wid.incomes.map(inc=>{
                                                        return(
                                                            <tr key={inc.id}>
                                                                <td>{inc.date}</td>
                                                                <td>{inc.payment_method}</td>
                                                                <td>${inc.amount}</td>
                                                            </tr>
                                                        )
                                                    })
                                                    }
                                                </tbody>
                                            </table>
                                }
                                else if(wid.type=="Latest Expences"){
                                    table=<table className="table">
                                                <thead className="thead-light">
                                                    <tr>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Payment Method</th>
                                                    <th scope="col">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {wid.payments.map(inc=>{
                                                        return(
                                                            <tr key={inc.id}>
                                                                <td>{inc.date}</td>
                                                                <td>{inc.payment_method}</td>
                                                                <td>${inc.amount}</td>
                                                            </tr>
                                                        )
                                                    })
                                                    }
                                                </tbody>
                                            </table>
                                }
    
                        return(
                                <div style={order} className={"dashboard-item dashboard-item-details"+ (wid.width==100? "width-full ":" ")+(wid.width==20? "width-twenty ":" ")+(wid.width==35? "width-thirty ":" ") }  key={wid.id}>
                                    <div  className="dashboard-item-details-header">
                                        <div className="dropdown">
                                            <span className="oi oi-menu " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                            <div className="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a className="dropdown-item" href="#">Action</a>
                                                <a className="dropdown-item" href="#">Another action</a>
                                                <a className="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                        <div>
                                            <p className="dashboard-item-details-name">{wid.widget_name}</p>
                                        </div>
                                    </div>
                                    <div>
                                        {table}
                                    </div>
                                </div>
                            )
    
                    }
                    
                })
    
                return(
                    <div>
                        
                        <div id="dashboard-header">
                            <div id="dashboard-title">
                                <p>Dashboard</p>
                                <div className="dropdown">
                                    <span className="oi oi-menu " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                    <div className="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a className="dropdown-item" href="#">Action</a>
                                        <a className="dropdown-item" href="#">Another action</a>
                                        <a className="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div id="dashboard-date">
                                <input onChange={(e)=>{this.setState({startDate:e.target.value})}} type="date" id="dasboard-start-date" name="startDate" />
                                <span className="oi oi-arrow-thick-right"></span>
                                <input onChange={(e)=>{this.setState({endDate:e.target.value})}} type="date" id="dashboard-end-date" name="endDate" />
                                <button onClick={this.sortByDate} >Go</button>
                            </div>
                        </div>

                        <div id="dashboard-items">
                            <div id="dashboard-items-cont">
                                {items}
                            </div>
                        </div>

                    </div>
                    
                )
            }
        }
    
        ReactDOM.render(
          <Dashboard />,
          document.getElementById('dashboard-cont')
        );
    
      </script>
@endsection