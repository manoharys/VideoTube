#include<stdio.h>
int main(){
 int n,k;
 printf("Enter the values of n and k\n");
 scanf("%d%d",&n,&k);
 if(n<k){
    printf("Enter the valid input\n");
    return;
 }
 printf("Binomial coeffient of %d and %d is %d",n, k , bino(n,k));
}

int bino(int n, int k){
  int c[n+1][k+1];
  for(int i=0;i<=n;i++){
    for(int j=0;j<=min(i,k);j++){
        if(j==0||j==i){
            c[i][j]=1;
        }
        else{
            c[i][j]=c[i-1][j-1]+c[i-1][j];
        }
    }

  }
   return c[n][k];
}
int min(int a , int b){
 if(a<b){
    return a;
 }
 else{
    return b;
 }
}
