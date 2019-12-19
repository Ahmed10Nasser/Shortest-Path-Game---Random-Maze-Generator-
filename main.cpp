#include<bits/stdc++.h>
using namespace std;

//Global Variables
int const n=11, M=8, OO = 0x3f3f3f3f;
int N;
int arr[n][n][M]; //M: 0-top 1-bottom 2-right 3-left 4-top right 5-bottom left 6-top left 7-bottom right
pair<int,int> grid[21][21];
bool vis[n][n];
int dis[n][n];
int dr[]={-1,1,0,0,-1,1,-1,1};
int dc[]={0,0,1,-1,1,-1,-1,1};


// Functions Prototypes
void BFS(int,int);
int random(int,int);
bool valid(int,int);
void dijkstra(int, int);
void gridMaking();



int main()
{
    freopen("level.txt","rt",stdin);
    freopen("ds.txt","wt",stdout);
    scanf("%d",&N);
    N++;
    do
    {
        memset(arr, 0, sizeof arr);
        BFS(0,0);
        dijkstra(0,0);
    }
    while(dis[N-1][N-1]==OO);
    gridMaking();

    printf("var dim = %d;\n",(2*N)-1);
    printf("var res = %d;\n",dis[N-1][N-1]);
    printf("var map = \[");
    for(int i=0; i<(2*N)-1; i++)
    {
        for(int j=0; j<(2*N)-1; j++)
        {
            if(i==0 && j==0)
                printf("\'S\',");
            else if(i==(2*N)-2 && j==(2*N)-2)
                printf("\'E\',");
            else if(i%2 && j%2)
            {
                if(grid[i][j].first==-1 && grid[i][j].second==-1)
                    printf("%s","\'W,W\',");
                else if(grid[i][j].first==-1 && grid[i][j].second!=-1)
                    printf("%s",("\'W,"+to_string(grid[i][j].second)+"\',").c_str());
                else if(grid[i][j].first!=-1 && grid[i][j].second==-1)
                    printf("%s",("\'"+to_string(grid[i][j].first)+",W\',").c_str());
                else
                    printf("%s",("\'"+to_string(grid[i][j].first)+","+to_string(grid[i][j].second)+"\',").c_str());
            }
            else
            {

                if(grid[i][j].first==-2 && grid[i][j].second==-2)
                    printf("\'%c\',",'T');
                else if(grid[i][j].first==-1 && grid[i][j].second==-1)
                    printf("\'%c\',",'W');
                else
                    printf("\'%d\',",grid[i][j].second);
            }
        }
        puts("");
    }
    printf("];");
    return 0;
}


//Functions
int random(int mn, int mx) //O(1)
{
   static bool first = true;
   if (first)
   {
      srand( time(NULL) ); //seeding for the first time only!
      first = false;
   }
   return mn + rand() % (( mx + 1 ) - mn);
}

bool valid(int r, int c) //O(1)
{
    return r>=0 && r<N && c>=0 && c<N;
}


void BFS(int sr, int sc) //O(N+M)
{
    memset(vis, 0, sizeof vis);
    int ur,uc,vr,vc,R,tR,tr,tc;
    queue<pair<int,int>> q;
    q.push({sr,sc});
    while(!q.empty())
    {
        ur=q.front().first;
        uc=q.front().second;
        q.pop();
        if(vis[ur][uc])
            continue;
        vis[ur][uc]=1;
        tr=ur*2;
        tc=uc*2;
        while(arr[ur][uc][0]==0 || arr[ur][uc][1]==0 || arr[ur][uc][2]==0 || arr[ur][uc][3]==0 || arr[ur][uc][4]==0 || arr[ur][uc][5]==0 || arr[ur][uc][6]==0 || arr[ur][uc][7]==0)
        {
            do
            {
                R=random(0,7);
            }
            while(arr[ur][uc][R]!=0);
            vr=ur+dr[R];
            vc=uc+dc[R];
            if(valid(vr,vc))
            {
                if(R==0 || R==2 || R==4 || R==6)
                    tR=R+1;
                else
                    tR=R-1;
                arr[ur][uc][R]= arr[vr][vc][tR]=random(1,200);
                if(arr[ur][uc][R]>100)
                    arr[ur][uc][R]= arr[vr][vc][tR]=-1;
                q.push({vr,vc});
            }
            else
                arr[ur][uc][R]=-2;

        }
    }
    return;
}

void dijkstra(int sr, int sc) //O(N+M)*log(N+M)
{
    int ur,uc,ud,vr,vc,vd;
    memset(dis, OO, sizeof dis);
    dis[sr][sc] = 0;
    priority_queue<pair<int,pair<int, int>>> q;
    q.push({0, {sr,sc}});
    while(!q.empty()){
        ur = q.top().second.first;
        uc = q.top().second.second;
        ud= -q.top().first;
        q.pop();
        if(dis[ur][uc] != ud)    continue;
        for(int i=0; i<8; i++)
        {
            if(arr[ur][uc][i]!=-1 && arr[ur][uc][i]!=-2)
            {
                vr=ur+dr[i];
                vc=uc+dc[i];
                vd=arr[ur][uc][i];
                if(dis[vr][vc]>dis[ur][uc]+vd)
                {
                    dis[vr][vc]=dis[ur][uc]+vd;
                    q.push({-dis[vr][vc],{vr,vc}});
                }
            }
        }
    }
    return;
}

///if(i is odd and j is odd)     --> Two-paths cell
//  {left path from top, right path from top}
//  the value = -1 means that there is no path
//  the values (1-100) mean that there is a path with distance (1-100)
//------------------------------------------------------------------------
///else                          --> Node cell or One-path cell
//  {-2,-2}         : Node cell
//  {-1,-1}         : No-path cell
//  {-1,(1,100)}    : one-path cell

void gridMaking()
{
    int ur,uc,vr,vc;
    for(int i=0; i<N; i++)
    {
        for(int j=0; j<N; j++)
        {
            ur=2*i;
            uc=2*j;
            grid[ur][uc]={-2,-2};
            for(int k=0; k<M; k++)
            {
                if(arr[i][j][k]!=-2)
                {
                    vr=ur+dr[k];
                    vc=uc+dc[k];
                    if(vr%2 && vc%2)
                    {
                        if(vr-ur==1 && vc-uc==1)
                            grid[vr][vc].first=arr[i][j][k];
                        else if(vr-ur==1 && vc-uc==-1)
                            grid[vr][vc].second=arr[i][j][k];
                    }
                    else
                        grid[vr][vc]={-1,arr[i][j][k]};
                }
            }
        }
    }
    return;
}

