//
//  trt
//
// Recursion + memorization:

#include <iostream>
#include <algorithm>

#define MAXN 2000

long treats[MAXN];
long cache[MAXN][MAXN];
int treatCount;

using namespace std;


long profit(int minLeft, int maxRight);


int main(int argc, const char * argv[]) {
    int i, j;
    for(i = 0; i < MAXN; i++) {
        treats[i] = -1;
        for(j = 0; j < MAXN; j++)
            cache[i][j] = -1;
    }
    
    cin >> treatCount;
    
    for(int i = 0; i < treatCount; i++) {
        cin >> treats[i];
    }
    
    cout << profit(0, treatCount);
    
    return 0;
}


long profit(int minLeft, int maxRight)
{
    if(minLeft > maxRight)
        return 0;
    if(cache[minLeft][maxRight] > -1)
        return cache[minLeft][maxRight];
    int age = treatCount - (maxRight - minLeft + 1) + 1;
    cache[minLeft][maxRight] = max(
                                   profit(minLeft + 1, maxRight) + treats[minLeft] * age,
                                   profit(minLeft, maxRight - 1) + treats[maxRight] * age
                                   );
    return cache[minLeft][maxRight];
}
