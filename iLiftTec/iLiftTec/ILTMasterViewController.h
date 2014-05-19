//
//  ILTMasterViewController.h
//  iLiftTec
//
//  Created by Ivan Diaz on 3/23/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "ILTJsonManager.h"

@interface ILTMasterViewController : UITableViewController <UITableViewDelegate, UITableViewDataSource>

@property(nonatomic) UITableViewCellAccessoryType accessoryType;
@property (strong, nonatomic) NSMutableArray *definicion;
@property (nonatomic) NSInteger btnSection;
@property (nonatomic) NSInteger btnRow;




-(void) updateDia: (NSInteger) dia ejercicio: (NSInteger) ejercicio completado: (BOOL) completad;

@end
